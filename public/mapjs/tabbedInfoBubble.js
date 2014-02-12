/*
 * @bubbleInfoNamespace
 *
 */


function TabbedInfoBubbles() {

		var clickFunction =  function (evt) {	
						if(evt.target.className == "nm_tab"){																		
								var offset = 0;		
								var tabs = evt.target.parentNode.children;
								var tabContent = this.children;
												
								while (offset < tabContent.length) {				    	   				    	  
										if (tabContent[offset].nodeName== "DIV" ) {
												break;
										}
										offset++;
								}
				
								for (var i = 0, len = tabs.length; i < len; i++){
										if ( tabs[i] == evt.target){
												tabs[i].className = 'nm_tab_current';
												tabContent[i+ offset].style.display ='block';
												$('.modal-footer').fadeIn(0);
										} else {
												tabs[i].className = 'nm_tab';
												tabContent[i + offset].style.display ='none';	
												$('.modal-footer').fadeOut(0);		  
										}						
								}
						}
				};

		this.attach = function (mapDisplay) {	
				 TabbedInfoBubbles.prototype.attach(mapDisplay);					
		};

		this.addTabbedBubble = function(tabs, content, title, coordinate){
			this.openBubble(tabbedContent(tabs, content, title), coordinate)	;
		};

		this.openBubble = function(content, coordinate){
			divLength = document.getElementsByClassName("nm_bubble_content").length;
			// TabbedInfoBubbles.prototype.openBubble(content, coordinate);
			// show modal 
			$('#myModal').modal('show');	
			$('#modal-content').html('<div class="nm_bubble_content">'+content+'</div>');
			
			
			wireUp(1);
			wireUp(0);

		};

		this.initBubble  = function(onUserClose, hideCloseButton) {
				TabbedInfoBubbles.prototype.initBubble(onUserClose, hideCloseButton)	;

		};


		function wireUp(index){

		    	var Page = nokia.maps.dom.Page;
				var EventTarget = nokia.maps.dom.EventTarget;
				
				var infoBubbleDisplay = document.getElementsByClassName("nm_bubble_content")[index]; 


				
				console.log(infoBubbleDisplay);
				Page(infoBubbleDisplay);
				
				EventTarget(infoBubbleDisplay);

				infoBubbleDisplay.addListener("click", clickFunction , false);
		};

		var tabbedContent = function (tabs, content, title){
				var myHTMLcontent = "<ul class=\"nm_tabnav\">";
				for (var i = 0; i < tabs.length; i++){
						if (i==0){
						 		myHTMLcontent = myHTMLcontent + "<li class=\"nm_tab_current\">"+ tabs[i] + "</li>";
						} else {
						 		myHTMLcontent = myHTMLcontent + "<li class=\"nm_tab\">"+ tabs[i] + "</li>";
						}
				}
				myHTMLcontent = myHTMLcontent + "</ul>" + title;
				for (var i = 0; i < content.length; i++){
					if (i==0){
						 		myHTMLcontent = myHTMLcontent + "<div>"+ content[i] + "</div>";
						} else {
						 		myHTMLcontent = myHTMLcontent + "<div>"+ content[i] + "</div>";
						}
			  }
				return myHTMLcontent;
		}


		this.getVersion = function(){
				return '1.0.1';
		}; 



};

// add nokia maps instance
TabbedInfoBubbles.prototype = new nokia.maps.map.component.InfoBubbles();

