
					<a href="http://www.nintendoage.com/forum/messageview.cfm?catid=22&amp;threadid=6082" target="_blank" original-href="http://www.nintendoage.com/forum/messageview.cfm?catid=22&amp;threadid=6082">Previous Week</a> - Palettes, Sprites<br><br><div><br class="webkit-block-placeholder"></div><div><span class="Apple-style-span" style="font-weight: bold; ">This Week</span>: &#xA0;one sprite is boring, so now we add many more! &#xA0;Also move that sprite around using the controller.</div><div><br class="webkit-block-placeholder"></div><div><span class="Apple-style-span" style="font-weight: bold; "><span class="Apple-style-span" style="font-size: large; ">Multiple Sprites</span></span></div><div><br class="webkit-block-placeholder"></div><div>Last time there was only 1 sprite loaded so we just used a few LDA/STA pairs to load the sprite data. &#xA0;This time we will have 4 sprites on screen. &#xA0;Doing that many load/stores just takes too much writing and code space. &#xA0;Instead a loop will be used to load the data, like was used to load the palette before. &#xA0;First the data bytes are set up using the .db directive:</div><div><br class="webkit-block-placeholder"></div><div><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">sprites:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0;&#xA0; &#xA0; ;vert tile attr horiz</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; .db $80, $32, $00, $80 &#xA0; ;sprite 0</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; .db $80, $33, $00, $88 &#xA0; ;sprite 1</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; .db $88, $34, $00, $80 &#xA0; ;sprite 2</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; .db $88, $35, $00, $88 &#xA0; ;sprite 3</span></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><br class="webkit-block-placeholder"></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">There are 4 bytes per sprite, each on one line.&#xA0; The bytes are in the correct order and easily changed.&#xA0; &#xA0; This is only the starting data, when the program is running the copy in RAM can be changed to move the sprite around.</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">Next you need the loop to copy the data into RAM.&#xA0; This loop also works the same way as the palette loading, with the X register as the loop counter.</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">LoadSprites:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDX #$00&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; start at 0</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">LoadSpritesLoop:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA sprites, x&#xA0; &#xA0; &#xA0; &#xA0; ; load data from address (sprites + x)</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; STA $0200, x&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; store into RAM address ($0200 + x)</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; INX &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; X = X + 1</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; CPX #$10&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; Compare X to hex $10, decimal 16</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; BNE LoadSpritesLoop &#xA0; ; Branch to LoadSpritesLoop if compare was Not Equal to zero</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; if compare was equal to 16, continue down</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">If you wanted to add more sprites, you would add lines into the sprite .db section then increase the CPX compare value.&#xA0; That will run the loop more times, copying more bytes.</span></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; ">Once the&#xA0;sprites have been loaded into RAM, you can modify the data there. &#xA0;</p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><br class="webkit-block-placeholder"></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><br></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; font-family: sans-serif; font-size: 12px; "><br class="webkit-block-placeholder"></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; font-family: sans-serif; font-size: 12px; "><br></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; font-family: sans-serif; font-size: 12px; "></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 18px/normal Helvetica; "><span style="letter-spacing: 0px; "><b>Controller Ports</b></span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">The controllers are accessed through memory port addresses $4016 and $4017.&#xA0; First you have to write the value $01 then the value $00 to port $4016.&#xA0; This tells the controllers to latch the current button positions.&#xA0; Then you read from $4016 for first player or $4017 for second player.&#xA0; The buttons are sent&#xA0; one at a time, in bit 0.&#xA0; If bit 0 is 0, the button is not pressed.&#xA0; If bit 0 is 1, the button is pressed.</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">Button status for each controller is returned in the following order: A, B, Select, Start, Up, Down, Left, Right.</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA #$01</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; STA $4016</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA #$00</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; STA $4016 &#xA0; &#xA0; ; tell both the controllers to latch buttons</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; ; player 1 - A</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; ; player 1 - B</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; ; player 1 - Select</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; ; player 1 - Start</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; ; player 1 - Up</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; ; player 1 - Down</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; ; player 1 - Left</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; ; player 1 - Right</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4017 &#xA0; &#xA0; ; player 2 - A</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4017 &#xA0; &#xA0; ; player 2 - B</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4017 &#xA0; &#xA0; ; player 2 - Select</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4017 &#xA0; &#xA0; ; player 2 - Start</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4017 &#xA0; &#xA0; ; player 2 - Up</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4017 &#xA0; &#xA0; ; player 2 - Down</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4017 &#xA0; &#xA0; ; player 2 - Left</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4017 &#xA0; &#xA0; ; player 2 - Right</span></p><div><span class="Apple-style-span" style="font-family: Monaco; font-size: 10px; "><br class="webkit-block-placeholder"></span></div>
<p></p><p></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 18px/normal Helvetica; "><span style="letter-spacing: 0px; "><b>AND Instruction</b></span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">Button information is only sent in bit 0, so we want to erase all the other bits.&#xA0; This can be done with the AND instruction.&#xA0; Each of the 8 bits is ANDed with the bits from another value.&#xA0; If the bit from both the first AND second value is 1, then the result is 1.&#xA0; Otherwise the result is 0.</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">0 AND 0 = 0</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">0 AND 1 = 0</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">1 AND 0 = 0</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">1 AND 1 = 1</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">For a full random 8 bit value:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; &#xA0; &#xA0; 01011011</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">AND &#xA0; 10101101</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">--------------</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; &#xA0; &#xA0; 00001001</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">We only want bit 0, so that bit is set and the others are cleared:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; &#xA0; &#xA0; 01011011&#xA0; &#xA0; controller data</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">AND &#xA0; 00000001&#xA0; &#xA0; AND value</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">--------------</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; &#xA0; &#xA0; 00000001&#xA0; &#xA0; only bit 0 is used, everything else erased</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">So to erase all the other bits when reading controllers, the AND should come after each read from $4016 or $4017:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; &#xA0; ; player 1 - A</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; AND #%00000001</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; &#xA0; ; player 1 - B</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; AND #%00000001</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; &#xA0; ; player 1 - Select</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; AND #%00000001</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 18px/normal Helvetica; "><span style="letter-spacing: 0px; "><b>BEQ instruction</b></span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">The BNE instruction was used earlier in loops to Branch when Not Equal to a compared value.&#xA0; Here BEQ will be used without the compare instruction to Branch when EQual to zero.&#xA0; When a button is not pressed, the value will be zero, so the branch is taken.&#xA0; That skips over all the instructions that do something when the button is pressed:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">ReadA:&#xA0;</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $4016 &#xA0; &#xA0; &#xA0; ; player 1 - A</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; AND #%00000001&#xA0; ; erase everything but bit 0</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; BEQ ReadADone &#xA0; ; branch to ReadADone if button is NOT pressed (0)</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; add instructions here to do something when button IS pressed (1)</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">ReadADone:&#xA0; &#xA0; &#xA0; &#xA0; ; handling this button is done</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 18px/normal Helvetica; "><span style="letter-spacing: 0px; "><b>CLC/ADC instructions</b></span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">For this demo we will use the player 1 controller to move the Mario sprite around.&#xA0; To do that we need to be able to add to values.&#xA0; The ADC instruction stands for Add with Carry.&#xA0; Before adding, you have to make sure the carry is cleared, using CLC.&#xA0; This sample will load the sprite position into A, clear the carry, add one to the value, then store back into the sprite position:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $0203 &#xA0; ; load sprite X (horizontal) position</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; CLC &#xA0; &#xA0; &#xA0; &#xA0; ; make sure the carry flag is clear</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; ADC #$01&#xA0; &#xA0; ; A = A + 1</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; STA $0203 &#xA0; ; save sprite X (horizontal) position</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 18px/normal Helvetica; "><span style="letter-spacing: 0px; "><b>SEC/SBC instructions</b></span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">To move the sprite the other direction, a subtract is needed.&#xA0; SBC is Subtract with Carry.&#xA0; This time the carry has to be set before doing the subtract:</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; LDA $0203 &#xA0; ; load sprite position</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; SEC &#xA0; &#xA0; &#xA0; &#xA0; ; make sure carry flag is set</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; SBC #$01&#xA0; &#xA0; ; A = A - 1</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; "><span style="letter-spacing: 0px; ">&#xA0; STA $0203 &#xA0; ; save sprite position</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><span style="letter-spacing: 0px; "></span><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 18px/normal Helvetica; "><span style="letter-spacing: 0px; "><b>Putting It All Together</b></span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">Download and unzip the <a href="scraper/files/controller.zip" target="_blank" original-href="http://www.nespowerpak.com/nesasm/controller.zip">controller.zip</a>&#xA0;</span><span style="letter-spacing: 0px; ">sample files.&#xA0; All the code above is in the controller.asm file.&#xA0; Make sure that file, mario.chr, and controller.bat is in the same folder as NESASM, then double click on controller.bat.&#xA0; That will run NESASM and should produce controller.nes.&#xA0; Run that NES file in FCEUXD SP to see small Mario.&#xA0; Press the A and B buttons on the player 1 controller to move one sprite of Mario.&#xA0; The movement will be one pixel per frame, or 60 pixels per second on NTSC machines.&#xA0; If Mario isn&apos;t moving, make sure your controls are set up correctly in the Config menu under Input...&#xA0; If you hold both buttons together, the value will be added then subtracted so no movement will happen.</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span style="letter-spacing: 0px; ">Try editing the ADC and SBC values to make him move faster.&#xA0; The screen is only 256 pixels across, so too fast and he will just jump around randomly!&#xA0; Also try editing the code to move all 4 sprites together.</span></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; ">Finally try changing the code to use the dpad instead of the A and B buttons. &#xA0;Left/right should change the X position of the sprites, and up/down should change the Y position of the sprites.</p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><br class="webkit-block-placeholder"></p><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 12px; margin-left: 0px; font: normal normal normal 12px/normal Helvetica; "><span class="Apple-style-span" style="font-weight: bold; ">NEXT WEEK</span>: &#xA0;Backgrounds, attribute table</p><div><br class="webkit-block-placeholder"></div>
<p></p><p></p></div>
				