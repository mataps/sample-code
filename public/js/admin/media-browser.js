var MediaBrowser = function (container, searchBtn, colorboxParams, selectedMedia, browseEl, selectOnClick) {
  var self = this;
  this.$el = container;
  this.browseEl = browseEl;
  this.searchBtn = searchBtn;
  this.selectedMedia = selectedMedia || [];
  this.colorboxParams = colorboxParams;
  this.listeners = [];
  this.tagClasses = ['label-info', 'label-danger', 'label-success', 'label-warning'];
  this.selectOnClick = !!selectOnClick;
  this.selected = [];

  //search input delay
  var timer = 0;
  this.searchBtn.on('keyup', function(e) {
    var input = $(this).val();
    clearInterval(timer);
    timer = setTimeout(function() {
      // self.showLoader();
      if($.trim(input)) {
        self.loadSearch(input);
      } else {
        self.loadMediaListing();
      }
    }, 600);
  });

  this.init();
};

MediaBrowser.prototype.loadSearch = function(input) {
  var self = this;
  $.get('/api/media', {'q': input}, function(res, textStatus, jqXHR) {
    if(res.success) {
      //display all media
      $.proxy(self.displayList(res.data), self);
    }
  });
};

MediaBrowser.prototype.init = function() {
  this.initListners();

  //create the list container
  this.initListContainer();

  //load all media listing
  this.loadMediaListing();
};

MediaBrowser.prototype.initListContainer = function() {
  var listContainer = $('<ul>').addClass('ace-thumbnails');
  this.$el.append(listContainer);
};

MediaBrowser.prototype.loadMediaListing = function() {
  var self = this;
  $.get('/api/media', function(res, textStatus, jqXHR) {
    if(res.success) {
      //display all media
      $.proxy(self.displayList(res.data), self);
    }
  });
};

MediaBrowser.prototype.clearList = function() {
  this.$el.find('ul.ace-thumbnails').empty();
};

MediaBrowser.prototype.displayList = function(list) {
  var self = this;

  this.clearList();
  for(var i=0; i<list.length; i++) {
    this.displayItem(list[i]);
  }

  var thumbs = this.$el.find('ul.ace-thumbnails');
  
  if(!this.selectOnClick) {
    this.$el.find('ul.ace-thumbnails [data-rel="colorbox"]').colorbox(this.colorboxParams);
  } else {
    this.$el.find('ul.ace-thumbnails [data-rel="colorbox"]').click($.proxy(self.onSelect, self));
  }

  $.map(this.selectedMedia, function (val) {
    thumbs.find('li[data-id='+val+'] .cboxElement').trigger('click');
  });

  this.selectedMedia = [];

  $("#cboxLoadingGraphic").empty().append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon
};

MediaBrowser.prototype.onSelect = function(e) {
  e.preventDefault();
  var item = $(e.currentTarget).closest('.item');

  //check if it is already selected
  if(!item.hasClass('selected')) {
    item.addClass('selected');
  } else {
    item.removeClass('selected');
  }

  this.updateSelectedCount();
};

MediaBrowser.prototype.updateSelectedCount = function () {
  if(!this.selectOnClick) return;

  var mediaCounter = this.browseEl.find('.media-counter');
  var count = this.$el.find('ul.ace-thumbnails .item.selected').length;

  if(!mediaCounter.length) {
    mediaCounter = $('<span class="help-block media-counter text-success" style="position: absolute; top: 15px; left: 5px;" />');
    mediaCounter.appendTo(this.browseEl);
  }

  mediaCounter.html(count);
  mediaCounter.append(' files selected');
};

MediaBrowser.prototype.displayItem = function(item) {
  var self = this;

  var itemEl = $('<li data-id="'+item._id+'" class="item"/>');
  var itemLink = $('<a data-rel="colorbox" class="cboxElement" href="'+item.path+'"/>')
                .append('<img src="'+item.path+'" alt="'+item.type+'" width="200" height="150"/>');
  var tags = $('<div class="tags"/>');
  for(var i = 0; i < item.tags.length; i++) {
    var tagContainer = $('<span class="label-holder"></span>');
    var tagClass = self.tagClasses.shift();
    tagContainer.append('<span class="label '+tagClass+'">'+item.tags[i]+'</span>');
    tagContainer.appendTo(tags);

    self.tagClasses.push(tagClass);
  }
  tags.appendTo(itemLink);

  var removeBtn = $('<a href="#" data-id="'+item._id+'"><i class="icon-remove red"></i></a>')
                  .on('click', function(e) {
                    e.preventDefault();
                    $.proxy(self.delete($(this).data('id')), self);
                  });

  var tools = $('<div class="tools" />').append(removeBtn);

  var selectedText = $(
    '<div class="selected-text"> \
      <div class="inner"> \
        <span>Selected</span> \
        <br> \
        <i class="icon-check"></i> \
      </div> \
    </div>'
  );

  if(this.selectOnClick) {
    itemLink.append(selectedText);
  } else {
    itemEl.append(tools);
  }

  itemEl.append(itemLink);
  
  itemEl.appendTo(this.$el.find('ul.ace-thumbnails'));
};

MediaBrowser.prototype.delete = function(id) {
  var self = this;
  $.post('/api/media/'+id, { '_method': 'delete' }, function(res, textStatus, jqXHR) {
    if(res.success) {
      self.$el.find('ul.ace-thumbnails li[data-id="'+id+'"]').remove();
    }
  });
};

MediaBrowser.prototype.on = function(event, selector, callback) {
  this.listeners.push({
    event: event,
    selector: selector,
    callback: callback
  });
};

MediaBrowser.prototype.initListners = function() {
  for(var i = 0; i < this.listeners.length; i++) {
    var listener = this.listeners[i];

    if(listener.hasOwnProperty('event')) {
      var callback = (typeof listener.callback == 'function') ? listener.callback : this[listener.callback];
      this.$el.on(listener.event, listener.selector, callback);
    }
  }
};