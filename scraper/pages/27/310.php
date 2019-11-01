<div class="mdl-card__title"><strong>bunnyboy</strong> posted on 
		
			
				
				May 25, 2014 at 10:40:56 PM 
			
			
			
			
		
	</div><div class="mdl-card__supporting-text">
					<div class="FTQUOTE">
	<i>Originally posted by: <b>SoleGooseProductions</b></i><br>
	<br>
	GameState2:&#xA0;<br>
	&#xA0; INC Timer<br>
	&#xA0; LDA Timer<br>
	&#xA0; CMP #$30<br>
	&#xA0; BEQ .Next1<br>
	&#xA0; RTS<br>
	.Next1 &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0;<strong> Gets here only when timer = 30</strong><br>
	&#xA0; LDA Timer<br>
	&#xA0; CMP #$60<br>
	&#xA0; BEQ .Next2 &#xA0; &#xA0; &#xA0; &#xA0; <strong>Which means Timer never = 60 here, branch never happens</strong><br>
	&#xA0;<br>
	&#xA0; LDA #$01<br>
	&#xA0; STA YCoordinate &#xA0; &#xA0; ;setting it to the next screen<br>
	<br>
	&#xA0; ;bankswitching, background, palette, sprite, and attribute loading occur here<br>
	<br>
	&#xA0; RTS<br>
	<br>
	.Next2 &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; <strong>So this code will never run</strong></div>
<br>
You either need to use branches other than BEQ, or do all the CMP/BEQ in a row with the RTS at the end<br>
<br>
&#xA0; LDA Timer<br>
&#xA0; CMP #$30<br>
&#xA0; BEQ step1<br>
&#xA0; CMP #$60<br>
&#xA0; BEQ step2<br>
&#xA0; CMP #$90<br>
&#xA0; BEQ step3<br>
&#xA0; RTS&#xA0;<br>
<br>
<br>
<br>
				</div><div class="mdl-card--border"></div>