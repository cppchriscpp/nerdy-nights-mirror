<div class="mdl-card__title"><strong>oleSchool</strong> posted on 
		
			
				
				Jul 30 at 2:34:47 AM 
			
			
			
			
		
	</div><div class="mdl-card__supporting-text">
					<div class="FTQUOTE"><i>Originally posted by: <b>KHAN Games</b></i><br>
&#xA0;
<div class="FTQUOTE"><i>Originally posted by: <b>oleSchool</b></i><br>
<br>
1.) Is buttons2 being populated with a byte of correct values?<br>
&#xA0;</div>
<br>
I don&apos;t know how to do the other two things you&apos;re asking, as I&apos;m pretty crappy with using the Debugger myself. But for this you just need to open the Hex editor in FCEUX (or Mesen) and look at the $0200-$02FF addresses. You can see what values all your sprites have for all their bytes. The addresses you gave for sprite 2 are wrong though (you gave the tile/attribute for sprite one, but v pos and tile for sprite two)<br>
<br>
And you can look in the $0000-00FF area for your zero page variable values (like Buttons and Buttons2), but you have to count how many reserved bytes you&apos;ve used ahead of these variables in order to narrow down exactly which byte to look at for each variable. (ie: the first zero page variable would be $0000, the second $0001, assuming they are all a single byte).<br>
<br>
I can show you how to use the Debugger to break when your Buttons variable is not zero, but other than that I don&apos;t know how to step through the AND reads.<br>
<br>
Open debugger and click on Add Breakpoint. After you&apos;ve figured out which address your Buttons variable is, you&apos;ll want to type this address in both Address fields. (If you can&apos;t deduce which zeropage variable is your Buttons variable, you can open the FCEUX Hex Editor and start pressing directions and a/b. You should see a value jumping around as you press them.)<br>
<br>
After you put the address in, you&apos;ll want to click on Write and then for condition put A != #0<br>
<br>
This is pretty much the extent of my debugging skills. <span class="sprites_emoticons absmiddle" id="emo_smile">&#xA0;</span> Good luck!</div>
<br>
Yeah, typo for sprite 2 addresses. I was thinking &quot;add 4&quot; when I backspaced, so I typed 4, then added 1 for $0205..lol but all good.&#xA0;<br>
<br>
Hex editor was great. I saw the 8th byte (reserved for buttons2) populate correctly with every type of button press, so thats good to go! Very cool tip to learn as well.&#xA0;<br>
<br>
I added the breakpoint, but nothing happened. Seemed pretty straight forward, but no matter which controller or direction / button pressed, nothing happened. Did I miss something?<br>
<br>
<br>
<br>
<br>
&#xA0;
				</div><div class="mdl-card--border"></div>