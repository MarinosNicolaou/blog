import { config, library, dom } from '@fortawesome/fontawesome-svg-core';
config.autoReplaceSvg = 'nest';
 
 
import {faThumbsUp,
        faThumbsDown,
        faHeart,
        faCheck }from '@fortawesome/free-solid-svg-icons';
 
library.add(faThumbsUp,
            faThumbsDown, 
            faHeart, 
            faCheck);
 
// Kicks off the process of finding <i> tags and replacing with <svg>
dom.watch()