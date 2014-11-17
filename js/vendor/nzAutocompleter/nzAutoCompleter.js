

function nzAutoCompleter( opts ) {
  var that = this;

  that.changeEvent = false;
  that.bodyEvent = false;
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

  that.openDialog = function( values ) {

    $('#that.options.dialogId').html("");

    $.each(values, function(i,e) { 
      $('#that.options.dialogId').append('<div>'+e.visibleText+'</div>');
    });

    $('#that.options.dialogId').show();
  }

  that.closeDialog = function( ) { 
    $('#that.options.dialogId').hide();
  }


  that.indexation = function() {
    $.each( that.options.data, function( i, row) {
      
      // index data
      var indexStr = '';

      $.each( that.options.searchIds, function(i2,e2) {
        eval( 'indexStr += " " + row.e2';
      })

      that.options.data[i].indexText = indexStr;

      // visible Data
      eval('that.options.data[i].visibleText = ' + that.options.visiblePattern + ';');
    });
  }

  that.searchCoincidences = function( ) {
    var returnArray = [];

    $.each(that.options.data, function(i,e) {
      returnArray.push(e);
    });

    return returnArray;
  }




  that.indexation();

  $(body).append('<div id="'+that.options.dialogId+'">asdfasdf</div>');
  $( that.options.divId ).change(function() {

    var res = that.searchCoincidences( $(that.options.divId).val() );
    if(  > 0 ) {
      that.openDialog( res );
    }
    else {
      that.closeDialog();
    }

  });



}