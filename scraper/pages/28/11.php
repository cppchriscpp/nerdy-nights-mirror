<div class="mdl-card__title"><strong>MetalSlime</strong> posted on 
		
			
				
				Apr 22, 2010 at 1:06:31 AM 
			
			
			
			
		
	</div><div class="mdl-card__supporting-text">
					Pretty cool!&#xA0; I saw this thread a few days ago but didn&apos;t have time to look through the code until today.&#xA0; Now that I&apos;ve looked through it I want to throw some ideas your way.&#xA0; BTW, what you wrote is just fine and you don&apos;t have to change anything.&#xA0; These are just ideas so feel free to ignore them if they don&apos;t work for you <img src="images/blank.gif" border="0" style="display: none;" original-src="/media/_images/expressions/face-icon-small-smile.gif">.&#xA0; Just some tips that could improve performance:<br><br>1) You can save some more bytes on your background data by removing the $FF terminator on all columns.&#xA0; Usually terminators are used when you have data of variable length, where you don&apos;t have any idea when it&apos;s going to end (dialogue text, for example).&#xA0; Since all your columns are the same size, you can know when you reach the end by keeping a count of how many tiles you&apos;ve processed.&#xA0; I&apos;d load the column size into an index register (or a temp variable if X and Y are both being used) and then decrement it every time you write a tile to the buffer.&#xA0; Column is finished when your counter reaches 0.&#xA0; Cutting the terminator will save you 16 bytes per screen, which makes a significant difference if you have a bunch of screens.<br><br>2) Not quite sure why you have a special case for the sky metatile.&#xA0;&#xA0; My guess is that you were trying to save a byte by not having to declare the sky metatile id in the case of a normal RLE, ie for a run of 8 you save a byte like this: $FE, sky_metatile_id, $08 -&gt; $FD, $08.<br><br>It makes some sense since sky is used a lot, but you use a lot of bytes hardcoding the subroutine to handle the special sky case and if you change the ordering of your tiles in the pattern tables, you have to hunt down the hardcoded special cases and change the codes manually.<br><br>Another way to do RLE is to have a bit (say, bit7) signify RLE mode instead of a whole byte.&#xA0; Then you can pack the RLE indicator in with the metatile ids.&#xA0; So instead of:<br><br>.byte $01, $02&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;2 metatiles<br>.byte $FE, $10, $04,&#xA0;&#xA0; ;a run of 4 metatiles<br>.byte $FE, $07, $06&#xA0;&#xA0; ;a run of 6 metatiles<br><br>you could have:<br><br>.byte $01, $02&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;2 metatiles<br>.byte $90, $04&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;a run of 4 (metatile id $10, with the RLE bit set)<br>.byte $87, $06&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;a run of 6 (metatile id $07, with the RLE bit set)<br><br>This way every run is 2 bytes and its generic so nothing needs to be hardcoded.<br><br>3) Your drawing buffer appears to draw every frame, even if there is no movement/change.&#xA0; In other words, when the player isn&apos;t moving, you keep drawing the same offscreen columns over and over again.&#xA0; This is ok for a demo, but in a game it wastes some drawing time that you might need to do other PPU updates.&#xA0; One way to solve this is to put a cap on the drawing buffer (say a $00).&#xA0; After you draw a column, put the cap at the beginning of your buffer.&#xA0; Then in your buffer-&gt;ppu subroutine, skip to RTS if the first byte is $00.<br><br>4) Your drawing buffer could be set up to draw strings of bytes instead of just individual bytes.&#xA0; Right now, you set the target PPU address via $2006 for each byte.&#xA0; But really you only need to write an address to $2006 once per column.&#xA0; The PPU supports column drawing (bit2 of $2000 toggles row/column drawing).&#xA0; So instead of your drawing buffer looking like this:<br><br>hi_address, lo_address, tile, hi_address, lo_address, tile, hi_address, lo_address, tile, etc ;3 PPU writes per tile!<br><br>you could have:<br><br>count, hi_address, lo_address, tile, tile, tile, tile, tile, tile ;set address once, and then 1 PPU write per tile<br><br>The key is to set the PPU to increment by 32 via bit2 in $2000 so that consecutive writes draws a column instead of a row (see <a href="http://wiki.nesdev.com/w/index.php/PPU_registers#Controller_.28.242000.29_.3E_write" target="_blank" original-href="http://wiki.nesdev.com/w/index.php/PPU_registers#Controller_.28.242000.29_.3E_write">http://wiki.nesdev.com/w/index.ph...</a> ).<br><br>Oops, gotta go to class.&#xA0; No time to edit.&#xA0; Hope that made some sense <img src="images/blank.gif" border="0" style="display: none;" original-src="/media/_images/expressions/face-icon-small-smile.gif">&#xA0; Good job, btw.&#xA0; Your code is starting to look slick! <br>
				</div><div class="mdl-card--border"></div>