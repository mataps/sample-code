function FbSharer ($el, trigger_el, select_all_el) {

	var self = this;
	this.$el = $el;
	this.trigger_el = trigger_el;
	this.select_all_el = select_all_el;
	this.listeners = [];
	this.permissions = 'read_friendlists';
	this.selectedFriends = [];
	this.friendlists = [
		{ id: 'all_friends', name: 'All Friends', selected: true, callback: 'loadAllFriends'},
		{ id: 'friends_to_invite', name: 'Friends to Invite', callback: 'loadFriendsToInvite'},
		{ id: 'close_friends', name: 'Close Friends', callback: 'loadCloseFriends'},
		{ id: 'selected', name: 'Selected', callback: 'loadSelectedFriends'}
	];

	this.on('click', 'li.friend', function(e) {
		if(!$(e.target).is('input'))
			$(this).find('input[type=checkbox]').trigger('click');
	});

	this.on('click', 'li.friend input[type=checkbox]', function(e) {
		var id = $(this).attr('data-id');
		var name = $(this).attr('data-name');
		var data = { id: id, name: name };
		var parent = $(this).parent('li.friend');

		if($(this).is(':checked')) {
			parent.addClass('checked');
			self.selectedFriends.push(data);
		} else {
			parent.removeClass('checked');
			self.selectedFriends = $.grep(self.selectedFriends, function(n) { return n.id != id; });
		}
	});

	var timer = 0;
	this.on('keyup', 'input#search', function(e) {
		var input = $(this).val();
		clearInterval(timer);
		timer = setTimeout(function() {
			self.showLoader();
			if($.trim(input)) {
				self.searchFriend(input);
			} else {
				self.loadAllFriends();
			}
		}, 600);
	});

	this.on('click', '.friendlists li', function(e) {
		e.preventDefault();
		var clicked_id = $(this).attr('data-id');

		for(var i = 0; i < self.friendlists.length; i++) {
			if(self.friendlists[i].id == clicked_id) {
				self.setSelectedList(self.friendlists[i]);
			}
		}
	});

	this.createElements();
	this.showLoader();
}

FbSharer.prototype.searchFriend = function(name) {
	var self = this;
    FB.api({
        method: 'fql.query',
        query: 'select uid, name from user where uid in (SELECT uid2 FROM friend WHERE uid1 = me()) and (strpos(lower(name), "' + name + '")>=0 OR strpos(name,"' + name + '")>=0)'
    }, function(response) {
        self.renderFriends(response);
    	self.hideLoader();
    });
};

FbSharer.prototype.on = function(event, selector, callback) {
	this.listeners.push({
		event: event,
		selector: selector,
		callback: callback
	});
};

FbSharer.prototype.init = function() {
	var self = this;
	this.initListners();
	this.loadAllFriends();
	this.loadFriendList();
	// this.checkPermissions(function() {
	// });
	return true;

};

FbSharer.prototype.checkPermissions = function(callback) {
	FB.api('/me/permissions', function(response) {
		if(response.hasOwnProperty('data')) {
			var permissions = response.data[0];

			if(permissions.hasOwnProperty('read_friendlists')) {
				callback();
			} else {
				//invoke the login request
				 FB.login(function(response) {
		             if (response.authResponse) {
			        	$.post('/authorize', { accessToken: response.authResponse.accessToken}, function(res) {
			        		if(res.hasOwnProperty('success') && res.success) {
			        			callback();
			        		} else {
			        			window.location.href = "/canvas";
			        		}
			        	});
			        } else {
			            window.location.href = "/canvas";
			        }
		        }, { scope: 'read_friendlists' });
			}
		}
	});
};

FbSharer.prototype.loadFriendList = function() {
	this.$el.find('.friendlists').empty();
	for(var i = 0; i < this.friendlists.length; i++) {
		this.addSelectList(this.friendlists[i]);
		// if(this.friendlists[i].hasOwnProperty('selected') && this.friendlists[i].selected == true) {
		// }
	}
};

FbSharer.prototype.addSelectList = function(data) {
	var list = $('<li><a href="#">'+ data.name +'</a></li>');
	list.attr('data-id', data.id);
	this.$el.find('.friendlists').append(list);
};

FbSharer.prototype.setSelectedList = function(data) {
	//find the selected
	var selected = this.$el.find('.list-name');
	var to_select = this.$el.find('.friendlists li[data-id='+ data.id +']');
	selected.attr('data-id', data.id);
	var current_list = this.$el.find('.friendlists li[data-id='+ selected.attr('data-id') +']');

	this.$el.find('.list-name').html(data.name);
	this.$el.find('input#search').val('');

	this[data.callback]();
};

FbSharer.prototype.loadAllFriends = function() {
	var self = this;
	this.showLoader();
	FB.api('/me/friends', function(response) {

		self.next = response.hasOwnProperty('paging') ? response.paging.next : self.next;
		var friends = response.hasOwnProperty('data') ? response.data : [];

		self.renderFriends(friends);
		self.hideLoader();
	});
	// setTimeout(function() {
	// 	var response = { data: [
	// 		{ id: 1, name: 'Ryan Navarroza' },
	// 		{ id: 2, name: 'Mark Penaranda' },
	// 	]};

	// 	self.renderFriends(response.data);
	// 	self.hideLoader();
	// }, 2000);
};

FbSharer.prototype.loadFriendsToInvite = function() {
	var self = this;
	this.showLoader();
	FB.api({
        method: 'fql.query',
        query: 'SELECT uid, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user != 1'
    }, function(response) {
        self.renderFriends(response);
        self.hideLoader();
    });
};

FbSharer.prototype.loadCloseFriends = function() {
	var self = this;
	this.showLoader();
	FB.api('/me/friendlists/close_friends?fields=members', function(response) {
		if(response.hasOwnProperty('data') && $.isArray(response.data) && response.data.length) {
			var members = response.data[0].members;
			self.renderFriends(members.data);
		}
		self.hideLoader();
	});
};

FbSharer.prototype.loadSelectedFriends = function() {
	this.showLoader();
	this.renderFriends(this.selectedFriends);
	this.hideLoader();
};

FbSharer.prototype.renderFriends = function(data) {
	for(var i = 0; i < data.length; i++) {
		this.renderFriend(data[i]);
	}
};

FbSharer.prototype.renderFriend = function(data) {
	var id = data.hasOwnProperty('id') ? data.id : data.uid;
	var name = data.hasOwnProperty('name') ? data.name : '';
	var selected = false;

	for(var i=0; i<this.selectedFriends.length; i++) {
		if(this.selectedFriends[i].id == id) {
			selected = true;
			break;
		}
	}

	var el = '<li class="friend"> \
					<input type="checkbox" name="friend[]" \
					data-id="'+ id +'" \
					data-name="'+ name +'" \
					value=""> \
					<img src="https://graph.facebook.com/'+ id +'/picture?type=square"> \
					<div class="friend-info"> \
						<span class="name">'+ name +'</span> \
					</div> \
				</li>';

	el = $(el);

	if(selected) {
		el.find('input[type=checkbox]').attr('checked','checked');
	}

	this.$el.find('ul.friends-list').append(el);
};

FbSharer.prototype.showLoader = function()
{
	this.$el.find('.friends-list').empty();
	this.$el.find('.friends').addClass('loading');
	$('.page .page-content .schools-container .loader').fadeIn(0);
};

FbSharer.prototype.hideLoader = function() {
	this.$el.find('.friends-list').removeClass('hidden');
	this.$el.find('.friends').removeClass('loading');
	$('.page .page-content .schools-container .loader').fadeOut(0);
};

FbSharer.prototype.createElements = function() {
	var shareWrapper = $('<div class="share-wrapper"></div>');
	var searchFriend = $('<div class="search-friend"> \
			<div class="input-group"> \
		      	<div class="input-group-btn"> \
			        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> \
			        	<span class="list-name">All Friends</span> \
		        		<span class="caret"></span> \
	        		</button> \
			        <ul class="dropdown-menu friendlists"> \
			        </ul> \
		      	</div><!-- /btn-group --> \
	      		<input type="text" class="form-control" placeholder="Search..." id="search"> \
	    	</div> \
		</div>');

	var friends_el = $('<div class="friends"> \
				<div class="message hidden"> \
					<h2>Thank you!</h2> \
					<p>Your request is successful.</p> \
				</div> \
				<ul class="friends-list"> \
					<div style="clear:both;"></div> \
				</ul> \
			</div> \
			<div style="clear:both;"></div>');

	shareWrapper.append(searchFriend);
	shareWrapper.append(friends_el);

	this.$el.append(shareWrapper);
};

FbSharer.prototype.initListners = function() {
	for(var i = 0; i < this.listeners.length; i++) {
		var listener = this.listeners[i];

		if(listener.hasOwnProperty('event')) {
			var callback = (typeof listener.callback == 'function') ? listener.callback : this[listener.callback];
			this.$el.on(listener.event, listener.selector, callback);
		}
	}

	if(typeof this.trigger_el != 'undefined') {
		this.trigger_el.on('click', $.proxy(this.onSubmit, this));
	}

	if(typeof this.select_all_el != 'undefined') {
		this.select_all_el.on('click', $.proxy(this.onSelecAll, this));
	}
};

FbSharer.prototype.onSelecAll = function(e) {
	e.preventDefault();

	var friends = this.$el.find('li.friend input[type=checkbox]');
	$.each(friends, function() {
		if( ! $(this).is(':checked')) {
			$(this).trigger('click');
		}
	});
};

FbSharer.prototype.onSubmit = function(e) {
	if(typeof e != 'undefined') {
		e.preventDefault();
	}

	var sendUIDs = '';
	var self = this;

    var friends = this.selectedFriends.splice(0, 25);

    for(var i = 0; i < friends.length; i++) {
        sendUIDs += friends[i].id + ',';
    }

    // Use FB.ui to send the Request(s)
    FB.ui({ method: 'apprequests',
	    to: sendUIDs,
	    title: 'Doon po sa amin contest',
	    message: 'Vote your favorite Doon po sa amin entry ',
    }, $.proxy(this.appRequest, this));
};

FbSharer.prototype.appRequest = function(response) {

	if(response.e2e!="{}"){
		 $.post('/app/invite-p',{s:response.to.length});
		notiPoints(response.to.length);
	}

	if(this.selectedFriends.length > 0) {
		this.showMessage('Sending', this.selectedFriends.length + ' friends remaining...');
		return this.onSubmit();
	}

	if(response && response.hasOwnProperty('request')) {
		this.showMessage('Thank you!', 'Your request is successful.', 5000);
	}
};

FbSharer.prototype.showMessage = function(title, message, delay) {
	var self = this;
	this.$el.find('.message').removeClass('hidden');
	this.$el.find('.friends-list').addClass('hidden');

	if(typeof delay != 'undefined') {
		setTimeout(function() {
			self.$el.find('.message').addClass('hidden');
			self.loadAllFriends();
		}, delay);
	}
};

FbSharer.prototype.shareToWall = function(caption){
	FB.ui({
  		method: 'feed',
  		caption: caption,
	}, function(response){});
}



