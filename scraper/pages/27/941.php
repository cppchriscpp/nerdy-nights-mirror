<div class="mdl-card__title"><strong>user</strong> posted on 
		
			
				
				Sep 1, 2017 at 4:25:27 PM 
			
			
			
			
		
	</div><div class="mdl-card__supporting-text">
					<div class="FTQUOTE">
	<i>Originally posted by: <b>brilliancenp</b></i><br>
	&#xA0;</div>
<br>
<br>
I use Linux now, and FcEux under Linux has no debug tools. If you have a win machine, try to open the tool that shows the bytes in RAM. Look at page $0100 after pressing any button except A. It it start filling up it is likely what I already told you. There is some chance that it is that I think, but not sure at all, I just looked at your code like 5 minutes, and tried the ROM quickly to see what it does.<br>
<pre>    MakeTransparent:
        LDA pDispFlags
        ORA #%00100000;transparent
        STA pDispFlags ; why?
        LDA pDispFlags ; why?
        AND #%11111110;set still
        STA pDispFlags
</pre>
By the way, if the logic in this snippet of code is correct (i.e. what you want is to ORA, then AND, such value, and then save it), then the two marked instructions (with &quot;why?&quot;) are completely useless I think: you are saving to load up again the same value right after. It seems pretty ambitious to me for a first project, my humble advice is to make sure to isolate your routines somehow and test them, and make sure that everything is correct, before adding more code. Step by step. Just my two cents, not a great programmer myself, and speaking from my experience only, this is why I say so.<br>
<br>
Cheers.
				</div><div class="mdl-card--border"></div>