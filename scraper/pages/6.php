
					<a href="http://www.nintendoage.com/forum/messageview.cfm?catid=22&amp;threadid=7974" target="_blank" original-href="http://www.nintendoage.com/forum/messageview.cfm?catid=22&amp;threadid=7974">Previous Week</a> - Multiple sprites, reading controllers<div><br></div><div><span class="Apple-style-span" style="font-weight: bold; ">This Week: &#xA0;</span>Now that you have a basic understanding of the NES tile graphics, we learn how to display one static non scrolling background. &#xA0;</div><div><span class="Apple-style-span" style="font-size: x-large; "><br></span></div><div><span class="Apple-style-span" style="font-weight: bold; "><span class="Apple-style-span" style="font-size: x-large; ">Backgrounds</span></span></div><div><span class="Apple-style-span" style="font-size: small; ">There are three components used to generate backgrounds on the NES. &#xA0;First is the background color palette, used to select the colors that will be used on screen. &#xA0;Next is the nametable that tells the layout of the graphics. &#xA0;Finally is the attribute table that assigns the colors in the palette to areas on screen.</span></div><div><span class="Apple-style-span" style="font-size: 18px; font-weight: bold; "><br></span></div><div><span class="Apple-style-span" style="font-weight: bold; "><span class="Apple-style-span" style="font-size: medium; ">Background Palette</span></span></div><div><span class="Apple-style-span" style="font-size: small; ">Like the sprites there are 16 colors in the <span class="Apple-style-span" style="font-weight: bold; ">background palette</span>. &#xA0;Our previous apps were already loading a background palette but it was not being used yet. &#xA0;You can use the PPU Viewer in FCEUXD SP to see the color palettes. &#xA0;</span></div><div><span class="Apple-style-span" style="font-size: 16px; font-weight: bold; "><br></span></div><div><span class="Apple-style-span" style="font-weight: bold; "><span class="Apple-style-span" style="font-size: medium; ">Nametables</span></span></div><div><span class="Apple-style-span" style="font-size: small; ">L</span><span class="Apple-style-span" style="font-size: small; ">ike the sprites, background images are made up from 8x8 pixel tiles. &#xA0;The screen video resolution is 32x30 tiles, or 256x240 pixels. &#xA0;PAL systems will show this full resolution but NTSC crops the top 8 and bottom 8 rows of pixels for a final resolution of 256x224. &#xA0;Additionally TV&apos;s on either system can crop another few rows on the top or bottom.</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: small; ">One screen full of background tiles is called a <span class="Apple-style-span" style="font-weight: bold; ">nametable</span>, and the NES has enough internal RAM connected to the PPU for two nametables. &#xA0;Only one will be used here. &#xA0;The nametable has one byte (0-255) for which 8x8 pixel graphics tile to draw on screen. &#xA0;The nametable we will use starts at PPU address $2000 and takes up 960 bytes (32x30). &#xA0;You can use the Nametable viewer in FCEUXD SP to see all the nametables. &#xA0;</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-weight: bold; "><span class="Apple-style-span" style="font-size: medium; ">Attribute Tables</span></span></div><div><span class="Apple-style-span" style="font-size: small; ">The attribute tables may be the most difficult thing to understand, and sets many of the graphics limitations. &#xA0;Each nametable has an <span class="Apple-style-span" style="font-weight: bold; ">attribute table</span> that sets which colors in the palette will be used in sections of the screen. &#xA0;The attribute table is stored in the same internal RAM as the nametable, and we will use the one that starts at PPU address $23C0 ($2000+960). &#xA0;</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; ">First the screen is divided into a 32x32 pixel grid, or 4x4 tiles. &#xA0;Each byte in the attribute table sets the color group&#xA0;(0-3)&#xA0;in the background palette that will be used in that area. &#xA0;That 4x4 tile area is divided again into 4 2x2 tile grids. &#xA0;Two bits of the attribute table byte are assigned to each 2x2 area. &#xA0;That is the size of one block in SMB. &#xA0;This limitation means that only 4 colors (one color group) can be used in any 16x16 pixel background section. &#xA0;A green SMB pipe section cannot use the color red because it already uses 4 colors.</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div align="baseline"><span class="Apple-style-span" style="font-size: 13px; ">When looking at a sample SMB screen, first the 4x4 tile grid is added and the palette is shown at the bottom:</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><img src="scraper/images/F837623F-9C98-E50B-F4D377EE82FA2BDA.png" original-src="http://www.NintendoAgeMedia.com/users/142/photobucket/F837623F-9C98-E50B-F4D377EE82FA2BDA.png"></span></div><div><span class="Apple-style-span" style="font-size: 16px; font-weight: bold; "><br></span></div><div><span class="Apple-style-span" style="font-size: small; ">You can see there are 8 grid squares horizontally, so there will be 8 attribute bytes horizontally. &#xA0;Then each one of those grid squares is split up into 2x2 tile sections to generate the attribute byte:</span></div><div align="baseline"><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><img src="scraper/images/F8376193-9343-AF0D-B8DA7BD8B7DD9301.png" original-src="http://www.NintendoAgeMedia.com/users/142/photobucket/F8376193-9343-AF0D-B8DA7BD8B7DD9301.png"></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; ">No 16x16 area can use more than 4 colors, so the question mark and the block cannot use the greens from the palette.</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-weight: bold; "><span class="Apple-style-span" style="font-size: medium; ">Uploading the data</span></span></div><div><span class="Apple-style-span" style="font-size: small; ">To set the background graphics your data has to be defined in your ROM using the .db directive, then copied to the PPU RAM. &#xA0;Some graphics tools will generate this data but here it will just be done manually. &#xA0;To keep it shorter only a few rows of graphics will be created. &#xA0;The same CHR file from SMB will be used here too. &#xA0;First the nametable data is defined, with each graphics row split into two 16 byte sections to keep lines shorter:</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">nametable:</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24&#xA0; ;;row 1</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24&#xA0; ;;all sky ($24 = sky)</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24&#xA0; ;;row 2</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24&#xA0; ;;all sky</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $24,$24,$24,$24,$45,$45,$24,$24,$45,$45,$45,$45,$45,$45,$24,$24&#xA0; ;;row 3</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$53,$54,$24,$24&#xA0; ;;some brick tops</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; "><br></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $24,$24,$24,$24,$47,$47,$24,$24,$47,$47,$47,$47,$47,$47,$24,$24&#xA0; ;;row 4</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$24,$55,$56,$24,$24&#xA0; ;;brick bottoms</p></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><span class="Apple-style-span" style="font-size: 12px; "><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; ">Then the attribute table data is defined. &#xA0;Each byte covers 4x4 tiles, so only 8 bytes are needed here. &#xA0;Binary is used so editing the 2 bits per 2x2 tile area is easier:</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">attribute:</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db %00000000, %00010000, %0010000, %00010000, %00000000, %00000000, %00000000, %00110000</p></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div></span></span></div><div><span class="Apple-style-span" style="font-size: 13px; ">And finally the same color palette as SMB is used:</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">palette:</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; .db $22,$29,$1A,$0F,&#xA0; $22,$36,$17,$0F,&#xA0; $22,$30,$21,$0F,&#xA0; $22,$27,$17,$0F</p></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; ">Just like our previous palette loading, a loop is used to copy a specific number of bytes from a memory location to the PPU. &#xA0;First the PPU address is set to the beginning of the nametable at $2000. &#xA0;Then our 128 bytes of background data are copied. &#xA0;Next the PPU address is set to the beginning of the attribute table at $23C0 and 8 bytes are copied.</span></div><div><br></div><div><span class="Apple-style-span" style="font-size: 13px; "><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">LoadBackground:</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; LDA $</span><span style="color: rgb(28, 0, 207); ">2002</span><span style="color: rgb(0, 0, 0); "> &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; </span>; read PPU status to reset the high/low latch</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; LDA <span style="color: rgb(0, 116, 0); ">#$20</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; STA $</span><span style="color: rgb(28, 0, 207); ">2006</span><span style="color: rgb(0, 0, 0); "> &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; </span>; write the high byte of $2000 address</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; LDA <span style="color: rgb(0, 116, 0); ">#$00</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; STA $</span><span style="color: rgb(28, 0, 207); ">2006</span><span style="color: rgb(0, 0, 0); "> &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; </span>; write the low byte of $2000 address</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; LDX </span>#$00&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; start out at 0</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">LoadBackgroundLoop:</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; LDA background, x &#xA0; &#xA0; </span>; load data from address (background + the value in x)</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; STA $<span style="color: rgb(28, 0, 207); ">2007</span> &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; <span style="color: rgb(0, 116, 0); ">; write to PPU</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; INX &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; <span style="color: rgb(0, 116, 0); ">; X = X + 1</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; CPX </span>#$80&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; Compare X to hex $80, decimal 128 - copying 128 bytes</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; BNE LoadBackgroundLoop&#xA0; </span>; Branch to LoadBackgroundLoop if compare was Not Equal to zero</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; </span>; if compare was equal to 128, keep going down</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; min-height: 14px; ">&#xA0;&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0;</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">LoadAttribute:</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; LDA $</span><span style="color: rgb(28, 0, 207); ">2002</span><span style="color: rgb(0, 0, 0); "> &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; </span>; read PPU status to reset the high/low latch</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; LDA <span style="color: rgb(0, 116, 0); ">#$23</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; STA $</span><span style="color: rgb(28, 0, 207); ">2006</span><span style="color: rgb(0, 0, 0); "> &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; </span>; write the high byte of $23C0 address</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; LDA <span style="color: rgb(0, 116, 0); ">#$C0</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; STA $</span><span style="color: rgb(28, 0, 207); ">2006</span><span style="color: rgb(0, 0, 0); "> &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; </span>; write the low byte of $23C0 address</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; LDX </span>#$00&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; start out at 0</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">LoadAttributeLoop:</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; LDA attribute, x&#xA0; &#xA0; &#xA0; </span>; load data from address (attribute + the value in x)</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; STA $<span style="color: rgb(28, 0, 207); ">2007</span> &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; <span style="color: rgb(0, 116, 0); ">; write to PPU</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; INX &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; <span style="color: rgb(0, 116, 0); ">; X = X + 1</span></p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; color: rgb(0, 116, 0); "><span style="color: rgb(0, 0, 0); ">&#xA0; CPX </span>#$08&#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; ; Compare X to hex $08, decimal 8 - copying 8 bytes</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; BNE LoadAttributeLoop</p><div><br></div></span></div><div><span class="Apple-style-span" style="font-size: 13px; ">The final changes are to tell the PPU to use the Pattern Table 0 graphics for sprites, and Pattern Table 1 for background:</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0;&#xA0;LDA #%10010000 ;enable NMI, sprites from Pattern 0, background from Pattern 1</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; STA $2000</p></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; ">Enable the background rendering:</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0;&#xA0;LDA #%00011110 ; enable sprites, enable background</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; STA $2001</p></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; ">And to tell the PPU that we are not doing any scrolling at the end of NMI:</span></div><div><span class="Apple-style-span" style="font-size: 13px; "><br></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0;&#xA0;LDA #$00</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; STA $2005</p>
<p style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font: normal normal normal 10px/normal Monaco; ">&#xA0; STA $2005</p></span></div><div><span class="Apple-style-span" style="font-size: 13px; "><div><span class="Apple-style-span" style="color: rgb(28, 0, 207); font-family: Monaco; font-size: 10px; "><br></span></div></span></div><div><span class="Apple-style-span" style="font-weight: bold; "><span class="Apple-style-span" style="font-size: large; ">Putting It All Together</span></span></div><div><span class="Apple-style-span" style="font-size: 18px; font-weight: bold; "><span class="Apple-style-span" style="font-family: Helvetica; font-size: 12px; font-weight: normal; "><span style="letter-spacing: 0px; ">Download and unzip the <a href="scraper/files/background2.zip" target="_blank" original-href="http://www.nespowerpak.com/nesasm/background2.zip">background2.zip</a>&#xA0;</span><span style="letter-spacing: 0px; ">sample files.&#xA0; All the code above is in the background.asm file.&#xA0; Make sure that file, mario.chr, and background.bat is in the same folder as NESASM, then double click on background.bat.&#xA0; That will run NESASM and should produce background.nes.&#xA0; Run that NES file in FCEUXD SP to see the background. &#xA0;Set it to PAL Emulation so you get to see the whole screen.</span></span></span></div><div><span class="Apple-style-span" style="font-family: Helvetica; "><br></span></div><div><span class="Apple-style-span" style="font-size: 18px; font-weight: bold; "><span class="Apple-style-span" style="font-family: Helvetica; font-size: 12px; font-weight: normal; "><span style="letter-spacing: 0px; ">Any background areas that you did not write to will still be using tile 0, which happens to be the number 0 in the SMB graphics. &#xA0;Try adding more nametable and attribute data to the .db sections, then changing the loops so they copy more bytes to the PPU RAM. &#xA0;You can also try changing the starting PPU address of the nametable and attribute table writes to move the rows further down.</span></span></span></div><div><span class="Apple-style-span" style="font-family: Helvetica; "><span class="Apple-style-span" style="font-size: small; "><br></span></span></div><div><span class="Apple-style-span" style="font-family: Helvetica; "><span class="Apple-style-span" style="font-size: small; "><br></span></span></div><div><span class="Apple-style-span" style="font-family: Helvetica; "><span class="Apple-style-span" style="font-weight: bold; "><span class="Apple-style-span" style="font-size: small; ">NEXT WEEK</span></span><span class="Apple-style-span" style="font-size: small; ">: &#xA0;Subroutines, game structure, states</span></span></div>
				