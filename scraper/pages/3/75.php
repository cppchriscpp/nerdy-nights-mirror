<div class="mdl-card__title"><strong>Cockroachcharlie</strong> posted on 
		
			
				
				Sep 15, 2015 at 7:00:28 PM 
			
			
			
			
		
	</div><div class="mdl-card__supporting-text">
					<div class="FTQUOTE"><i>Originally posted by: <b>Vectrex280996</b></i><br>
&#xA0;
<div class="FTQUOTE"><i>Originally posted by: <b>Cockroachcharlie</b></i><br>
<br>
LOL. Man. I can see why people wanted to simplify it. Assembly is seriously a lot different than anything I have ever worked with so far. Again. It&apos;s just hard to grasp how number transferring produces these results. Almost like trying to visualize in pure binary. So now that I have the actual coding a little more in place, I should probably work more on the architecture and the specifics of memory locations?</div>
<br>
You&apos;ll get used to the registers, there aren&apos;t too many so you&apos;ll get a good grasp on how they work the more you program.<br>
<br>
Also, here&apos;s how I would do a &quot;Hello World&quot; program if you&apos;re interested (Basically what KHAN said in code form). It&apos;s covered in a later tutorial, because even simple things like that need to have you understand the registers and what they do.<br>
<br>
&#xA0;&#xA0;<br>
<span style="font-family:courier new,courier,monospace;"><span style="font-size:12px;">&#xA0; LDA $2002 &#xA0; &#xA0; &#xA0; ;wake up PPU<br>
&#xA0;&#xA0;LDA #$22<br>
&#xA0;&#xA0;STA $2006 &#xA0; &#xA0; &#xA0; ;Write the hi part of the starting address to $2006<br>
&#xA0;&#xA0;LDA #$00<br>
&#xA0;&#xA0;STA $2006 &#xA0; &#xA0; &#xA0; ;and the second part.<br>
&#xA0;&#xA0;LDX #$00<br>
.hwloop<br>
&#xA0;&#xA0;LDA helloworld,x &#xA0; &#xA0; &#xA0; ;Draws h, e, l, l, o, etc. on the background with $2007<br>
&#xA0;&#xA0;STA $2007<br>
&#xA0;&#xA0;INX &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0;;x register makes the writing possible<br>
&#xA0;&#xA0;CPX #$0B &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ;Do it 11 times<br>
&#xA0;&#xA0;BNE .hwloop<br>
<br>
helloworld:<br>
&#xA0;&#xA0;.db $11,$0E,$15,$15,$18,$2F,$20,$18,$1B,$14,$0D<br>
&#xA0;&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0;;The CHR goes like that.______0123456789ABCDEF<br>
&#xA0;&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0;;That&apos;s just my way of using__GHIJKLMNOPQRSTUV<br>
&#xA0;&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0;;using fonts on the CHR tho.__WXYZ.,-!?&#xA9;:;&apos;()&#xA0;</span></span><br>
&#xA0;</div>
<br>
I think I am starting to see what you mean.&#xA0; I actually grasped a lot of the &quot;what&quot; in what you wrote.&#xA0; It&apos;s the &quot;why&quot; that is still elusive, but coming together.&#xA0; From a basic standpoint, some parts of memory act as temporary/permanent data holders, while others act as (sorta) switchboards.&#xA0; I think with a little more research into the hardware topic itself (both my books fail to cover such aspects, but then, both were written in 1980 for a specific board).<br>
<br>
LOL.&#xA0; Sadly, in the class I took, as well as all studies, the actual hardware part was always where I was left with swirly eyes.&#xA0; But.&#xA0; My son and I are bound and determined to put a game onto our favorite console, so for once I have a reason not to just say to hell with it all.&#xA0; :-)<br>
&#xA0;
				</div><div class="mdl-card--border"></div>