var MediaManager = function (options) {
  var self = this;
  this.tagClasses = ['label-info', 'label-danger', 'label-success', 'label-warning'];
  this.colorboxParams = options.colorbox_params;
  this.triggerEl = options.trigger;
  this.listeners = [];
  this.maxDisplay = 24;
  this.data = [];

  this.init();
};

MediaManager.prototype.init = function() {
  this.initElements();
  this.initListners();
  this.updateSelectedCount();
};

MediaManager.prototype.initElements = function() {
  this.$el = $(' \
  <div class="modal fade" id="mediaBrowser" tabindex="-1" role="dialog" aria-labelledby="mediaBrowserLabel" aria-hidden="true"> \
    <div class="modal-dialog"> \
      <div class="modal-content"> \
        <div class="modal-header"> \
          <div class="btn-group"> \
            <button type="button" class="btn btn-inverse" id="gallery">Gallery</button> \
            <button type="button" class="btn btn-inverse" id="media-server">Media Server</button> \
          </div> \
          <button type="button" data-dismiss="modal" data-target="mediaBrowse" class="bootbox-close-button close" style="margin-top: -10px;">×</button> \
          <input type="text" id="search-media" placeHolder="Search here..." autocomplete="off" style="margin-right: 50px;"/> \
        </div> \
        <div class="modal-body"> \
          <ul class="ace-thumbnails"></ul> \
        </div> \
        <div class="clearfix"></div> \
        <div class="modal-footer"> \
          <button type="button" class="btn btn-default" id="load-more">Load More...</button> \
          <button type="button" class="btn btn-default" data-dismiss="modal" data-target="mediaBrowse" id="close">Close</button> \
        </div> \
      </div> \
    </div> \
  </div>');

  $('body').append(this.$el);

  this.$el.find('#mediaBrowser').modal({
    keyboard: false,
    show: false,
    backdrop: false
  });
};

MediaManager.prototype.initListners = function() {
  var self = this;

  for(var i = 0; i < this.listeners.length; i++) {
    var listener = this.listeners[i];

    if(listener.hasOwnProperty('event')) {
      var callback = (typeof listener.callback == 'function') ? listener.callback : this[listener.callback];
      this.$el.on(listener.event, listener.selector, callback);
    }
  }

  this.triggerEl.on('click', function(e) {
    e.preventDefault();
    self.$el.modal('show');
  });
  this.$el.on('shown.bs.modal', function (e) {
    self.showGallery();
    self.maxDisplay = 24;
  });
  this.$el.on('hidden.bs.modal', function (e) {
    self.clearList();
    self.updateSelectedCount();
  });
  this.$el.find('#gallery').on('click', function() {
    self.$el.find('#search-media').val('');
    self.showGallery();
  });
  this.$el.find('#media-server').on('click', function() {
    self.$el.find('#search-media').val('');
    self.showMediaServer();
  });

  this.$el.find('#load-more').click(function() {
    self.loadMoreImages();
  });

  //search input delay
  var timer = 0;
  this.$el.find('#search-media').on('keyup', function(e) {
    var input = $(this).val();
    clearInterval(timer);
    timer = setTimeout(function() {
      // self.showLoader();
      if($.trim(input)) {
        self.loadSearch(input);
      } else {
        if($('#media-server').hasClass('active')) {
          self.showMediaServer();
        } else {
          self.showGallery();
        }
      }
    }, 600);
  });
};

MediaManager.prototype.loadMoreImages = function() {
  //check if we have media server active
  if($('#media-server').hasClass('active')) {
    this.maxDisplay += 24;
    this.showMediaServer();
  } else {
    this.maxDisplay += 24;
    this.showGallery();
  }
};

MediaManager.prototype.clearList = function() {
  this.$el.find('ul.ace-thumbnails').empty();
};

MediaManager.prototype.showGallery = function() {
  $('#gallery').addClass('active');
  $('#media-server').removeClass('active');
  this.loadGallery();
};

MediaManager.prototype.loadGallery = function() {
  var self = this;
  $.get('/api/media', function(res) {
    if(res.success) {
      //format data
      if(typeof window.app_media == 'object') {
        //display all media
        return $.proxy(self.displayList(res.data), self);
      }

      //display only
      self.$el.find('ul.ace-thumbnails').empty().append('<h3>This gallery is empty...</h3>')
    }
  });
};

MediaManager.prototype.showMediaServer = function() {
  $('#gallery').removeClass('active');
  $('#media-server').addClass('active');
  this.loadServerFiles();
};

MediaManager.prototype.loadServerFiles = function() {
  var self = this;
  $.get('/api/media', function(res) {
    if(res.success) {
      //format data
      return $.proxy(self.displayList(res.data), self);
    }
  });
};

MediaManager.prototype.loadSearch = function(input) {
  var self = this;
  $.get('/api/media', {'q': input}, function(res, textStatus, jqXHR) {
    if(res.success) {
      //display all media
      $.proxy(self.displayList(res.data), self);
    }
  });
};

MediaManager.prototype.clearList = function() {
  this.$el.find('ul.ace-thumbnails').empty();
};

MediaManager.prototype.displayList = function(list) {
  var self = this;
  this.clearList();

  for(var i=0; i<list.length; i++) {
    if($('#media-server').hasClass('active') && i >= this.maxDisplay) {
      continue;
    }

    this.displayItem(list[i]);
  }

  this.$el.find('ul.ace-thumbnails [data-rel="colorbox"]').colorbox(this.colorboxParams);
  $("#cboxLoadingGraphic").empty().append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon
};

MediaManager.prototype.updateSelectedCount = function () {
  var mediaCounter = this.triggerEl.find('.media-counter');
  var count = window.app_media.length;

  if(!mediaCounter.length) {
    mediaCounter = $('<span class="help-block media-counter text-success" style="position: absolute; top: 15px; left: 5px;" />');
    mediaCounter.appendTo(this.triggerEl);
  }

  mediaCounter.html(count);
  mediaCounter.append(' files selected');
};

MediaManager.prototype.displayItem = function(item) {
  var self = this;

  //check if we have media server active
  if($('#media-server').hasClass('active') && ~$.inArray(item._id, window.app_media)) {
    return;
  }
  if($('#gallery').hasClass('active') && !~$.inArray(item._id, window.app_media)){
    return;
  }

  var itemEl = $('<li data-id="'+item._id+'" class="item"/>');
  var itemLink = $('<a data-rel="colorbox" class="cboxElement" href="'+item.path+'"/>')
                .append('<img src="'+item.path+'" alt="'+item.type+'" width="200" height="150"/>');

  var removeBtn = $('<a href="#" data-id="'+item._id+'"><i class="icon-remove red"></i></a>')
                  .on('click', function(e) {
                    e.preventDefault();
                    if(confirm('Are you sure you want to delete this?')) {
                      $.proxy(self.delete($(this).data('id')), self);
                    }
                  });
  var addBtn = $('<a href="#" data-id="'+item._id+'"><i class="icon-exchange green"></i></a>')
                  .on('click', function(e) {
                    e.preventDefault();

                    //check if we have media server active
                    if($('#media-server').hasClass('active')) {
                      self.addToGallery($(this).data('id'));

                    } else {
                      self.removeFromGallery($(this).data('id'));
                    }
                  });

  var tools = $('<div class="tools" />')
                .append(removeBtn)
                .append(addBtn);

  //check if we have media server active
  if($('#gallery').hasClass('active') && item._id !== window.featured_image) {
    var featuredBtn = $('<a href="#" data-id="'+item._id+'"><i class="fa fa-star label-warning"></i></a>')
                  .on('click', function(e) {
                    e.preventDefault();
                    self.setFeatured($(this).data('id'));
                  });

    tools.append(featuredBtn)
  }

  itemEl.append(tools);

  itemEl.append(itemLink);

  if(item._id == window.featured_image) {
    itemEl.addClass('featured');
  }

  itemEl.appendTo(this.$el.find('ul.ace-thumbnails'));
};

MediaManager.prototype.setFeatured = function(id) {
  window.featured_image = id;
  this.$el.find('ul.ace-thumbnails li').removeClass('featured');
  this.$el.find('ul.ace-thumbnails li[data-id="'+id+'"]').addClass('featured');
  this.showGallery();
};

MediaManager.prototype.addToGallery = function(id) {
  if(typeof window.app_media === 'object' && !~$.inArray(id, window.app_media)) {
    window.app_media.push( id );
  } else {
    window.app_media = [id];
  }
  this.$el.find('ul.ace-thumbnails li[data-id="'+id+'"]').remove();
};

MediaManager.prototype.removeFromGallery = function(id) {
  if(typeof window.app_media === 'object') {
    var pos = $.inArray(id, window.app_media);
    if(~pos) {
      window.app_media.splice(pos, 1);
      this.$el.find('ul.ace-thumbnails li[data-id="'+id+'"]').remove();
    }
  }
};

MediaManager.prototype.delete = function(id) {
  var self = this;
  $.post('/api/media/'+id, { '_method': 'delete' }, function(res, textStatus, jqXHR) {
    if(res.success) {
      self.$el.find('ul.ace-thumbnails li[data-id="'+id+'"]').remove();
    }
  });
};

MediaManager.prototype.on = function(event, selector, callback) {
  this.listeners.push({
    event: event,
    selector: selector,
    callback: callback
  });
};