<?php

function rules( $page )
          {
                $body = '
                            <ul>
                                  <li> If you just typed in an answer and nothing is happening, you ought to try the submit button.</li>
                                  <li> If our server says your answer is wrong, it probably is. However, you are allowed to submit the same answer any number of times if you feel the server is wrong.</li>
                                  <li> You may use any means to acquire the correct answer; this includes ransacking your college library, asking your grandmother, dancing around a fire chanting mantras and sacrificing your retarded neighbour to the gods.</li>
                                  <li> If the above forays fail to bear fruit, it is strongly suggested that you employ the services of an internet search engine that goes by the name \'Google\'( If you haven\'t heard of it, Google it)</li>
                                  <li> Questions too difficult? Grab a chair, sit down and wait for us to care.      ( oh, and let us know when the apocalypse hits)</li>
                                  <li> Feel free to try and hack into our server. We\'re even giving away free     \'I Suck Big-time\' T-Shirts for you lot.</li>
                                  <li> If you are seeing the alphabet \'e\' surrounded by a yellow ring anywhere in your browser window, it may very well be that you are using Internet Explorer. You may now proceed to rip the bars off your window and jump out.</li>
                                  <li> How and when we give you clues is solely dependent on the administrator.</li>
                                  <li> It is perfectly within the jurisdiction of the administrator to move through any level.</li>
                                  <li> What are you waiting for? Go whack your brains. See you at the finish line.</li>
                                  <li> Last but not the least, one SERIOUS advice : type in the captcha in capital letters without space. </li>
                            </ul>';
                
                $page = str_replace('{question}', 'Rules', $page);
                $page = str_replace('{image_replace}', '<div id="image">'.$body.'</div>', $page); 
                return $page;                
          }

?>          