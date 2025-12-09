/**
 * PhotoSwipe Initialization Logic (Modified to accept a single element selector)
 */
var initPhotoSwipeForDog = function(gallerySelector) {

    // parse slide data (url, title, size ...) from DOM elements
    var parseThumbnailElements = function(el) {
        // ... (This function remains UNCHANGED) ...
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {
            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes
            if(figureEl.nodeType !== 1) {
                continue;
            }

            // Check if the figure is a gallery item before proceeding
            if (figureEl.className.indexOf('col-') === -1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            // Ensure the link element has the necessary attributes
            if (!linkEl || !linkEl.getAttribute('data-size')) {
                continue;
            }

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };

            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML;
            }

            if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            } 

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if(!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        var clickedGallery = closest(clickedListItem, function(el) {
            // Find the main gallery container (the one the event was bound to)
            return el.className && el.className.indexOf('my-gallery') > -1;
        });
        
        var childNodes = clickedGallery.children[0].childNodes, // Look inside the .row
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) {
                continue;
            }

            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }

        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    // parse picture index and gallery index from URL (this is usually ignored in modal contexts)
    var photoswipeParseHash = function() {
        // ... (This function remains UNCHANGED) ...
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');
            if(pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        // Find the pswp root element unique to this gallery
        var pswp = galleryElement.nextElementSibling, 
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {
            // NOTE: We rely on the unique ID provided in the HTML for the galleryUID
            galleryUID: galleryElement.getAttribute('data-pswp-uid'), 

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }
        };
        
        // ... (URL parsing logic remains the same, simplified here for space) ...
        if(fromURL) {
            // ... URL parsing logic ...
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswp, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // --- Start of new initialization logic ---
    // The core change: Instead of selecting ALL galleries, we focus on the single provided selector.
    var galleryElement = document.querySelector( gallerySelector );

    if (galleryElement) {
        // Assign a unique UID based on the element's ID for URL history (if needed)
        var uniqueId = galleryElement.id.replace(/\D/g, ''); // Extract ID number
        galleryElement.setAttribute('data-pswp-uid', uniqueId || 1); 
        
        // Bind the click handler to the specific gallery element
        galleryElement.onclick = onThumbnailsClick;
    }
    
    // NOTE: We remove the automatic URL parsing here, as modal content changes frequently.
    
};


// =========================================================================
// jQuery READY FUNCTION (The key fix for modals!)
// =========================================================================

$('document').ready(function(){
    
    // Masonry grid initialization (kept for completeness)
    if($('.masonry-grid').length > 0){
        $('.masonry-grid').masonry({
             itemSelector: '.grid-item',
             columnWidth: '.grid-sizer',
        });
    }

    // 💡 THE MODAL FIX: BIND PHOTOSWIPE INITIALIZATION TO THE MODAL OPEN EVENT
    // Target all dog view modals that start with ID 'viewDog'
    $('[id^="viewDog"]').on('shown.bs.modal', function() {
        var dogId = $(this).attr('id').replace('viewDog', '');
        var galleryIdSelector = '#dogGalleryContainer' + dogId;
        
        // Check if the unique gallery exists and initialize PhotoSwipe for THIS dog.
        if ($(galleryIdSelector).length) {
            initPhotoSwipeForDog(galleryIdSelector);
        }
    });

    // NOTE: The original line initPhotoSwipeFromDOM('.my-gallery'); is removed.
    
});