<?php

function rules( $page )
          {
                $body = '
                           <ul><li>Once you have entered in the answer , remember to hit the submit button.</li>
<li> If nothing happens u may try again how much ever u may please.</li>
<li> The server decides whether your answer is right or wrong , but u are allowed to submit the answers any no of times you want.</li>
<li> If there is a will there is always a way, you can use any means to find the answers starting from running around berserk, asking your neighbours to summoning the Alladin’ s genie to find the answers for you.</li>
<li> Still at all the hopes end you may employ the assistance of an internet search engine which goes by the name “ GOOGLE” . A digital solution to all your problems , Blitz here comes the answers in a fraction of seconds.</li>
<li> Are the questions too difficult???? Calm down and relax , we do care for you darling where ever you are and please be patient ,cause the clues are on the way to help you if you are stuck up there for too long. </li>
<li> Do not come up with absurd ideas to hack our servers for the answer cause thieves "be warned that you will be banished from this dazzling game of ours".</li>
<li> When you type the answers make sure you answer it as a single word, despite the fact that it may contain any no of words(ex answer is adolfhitler)</li>
<li> Make sure that you answer all the questions in small letters.</li>
<li> The administrator is the god the all mighty here, he decides on when to and how to provide you with the precious clues.</li>
<li> What are waiting for? Still transfixed at the questions?</li>
<li> The winner will be declared on the last day of the treasure hunt, it will be a manasin who completes the game or answers the most no of questions first.</li>
<li> Time to set your brains on fire .Get bamboozled with awe !</li>
<li> Wish you good luck , Let see the ultimate champion at the finish line.</li></ul>';
                
                $page = str_replace('{question}', 'Rules', $page);
                $page = str_replace('{image_replace}', '<div id="image">'.$body.'</div>', $page); 
                return $page;                
          }

?>          