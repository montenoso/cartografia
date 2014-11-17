

function nzAutoCompleter( opts ) {
  var that = this;


  that.bodyClickEvent = false;
  that.rowsClickEvent = false;
  that.dialogContent = [];

  that.options = {
    divId: false,
    dialogId: false,
    data: {},
    searchIds: [],
    visiblePattern: '""',
    actionSelect: function( row ) {}
  };
  $.extend(true, that.options, opts);


  that.setPosition = function() {
    var searchPos = $( '#' + that.options.divId ).offset();
    var searchH = $( '#' + that.options.divId ).height();
    $('#'+that.options.dialogId).css('position', 'absolute');
    $('#'+that.options.dialogId).css('top', searchPos.top + searchH );
    $('#'+that.options.dialogId).css('left', searchPos.left );

  }

  that.openDialog = function( values ) {

    $('#'+that.options.dialogId).html("");
    that.setPosition();

    $.each(values, function(i,e) { 
      $('#'+that.options.dialogId).append('<div class="row" rowId="'+ e.nzRowId +'">'+e.visibleText+'</div>');
    });

    $('#'+that.options.dialogId).show();

    
    // bind each row
    that.rowsClickEvent = $('#'+that.options.dialogId).find('.row').click( 
      function( e ){
        //console.log(e.target)
        if( $(e.target).attr('rowId')){
          that.options.actionSelect(that.options.data[ $(e.target).attr('rowId') ]);
        }
        else {
          that.options.actionSelect(that.options.data[ $(e.target).parent().attr('rowId') ]);
        }
      });
    
    // Bind body click closes dialog
    that.bodyClickEvent = $('body').bind('click', function(){
      that.closeDialog();
    })
  }

  that.closeDialog = function( ) { 
    $('#'+that.options.dialogId).hide();
    if(that.bodyClickEvent)
      that.bodyClickEvent.unbind();
    if(that.rowsClickEvent)
      that.rowsClickEvent.unbind();
  }


  that.indexation = function() {
    $.each( that.options.data, function( i, row) {
      
      // index data
      var indexStr = '';

      $.each( that.options.searchIds, function(i2,e2) {
        eval( 'indexStr += " " + row.'+ e2 +';');
      })

      that.options.data[i].indexStr = indexStr;

      // visible Data
      eval('that.options.data[i].visibleText = ' + that.options.visiblePattern + ';');

      // set nz row id
      that.options.data[i].nzRowId = i;
    });
  }

  that.searchCoincidences = function( ) {
    var searchValues = $( '#' + that.options.divId ).val().split(' ');
    var returnArray = [];


    $.each(that.options.data, function(i,e) {

      var coincide = false;
      $.each(searchValues, function(i2,e2) {
        eval('coincidencia = e.indexStr.match(/\\b'+  searchValues[0] +'/gi);');
        if(coincidencia) {
          coincide = true;
        }
      });

      if(coincide) {
        returnArray.push(e);
      }
    });

    return returnArray;
  }




  that.indexation();

  $('body').append('<div class="nzAutoCompleterDialog" style="display:none;" id="'+that.options.dialogId+'"></div>');

  $( '#' + that.options.divId ).on('keyup' ,function() {

    var res = that.searchCoincidences( $(that.options.divId).val() );

    if( res.length > 0 && $( '#' + that.options.divId ).val() != '' ) {
      that.openDialog( res );
    }
    else {
      that.closeDialog();
    }

  });



}