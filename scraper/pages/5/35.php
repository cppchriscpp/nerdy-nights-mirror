<div class="mdl-card__title"><strong>Mario&apos;s Right Nut</strong> posted on 
		
			
				
				Feb 19, 2010 at 1:44:42 PM 
			
			
			
			
		
	</div><div class="mdl-card__supporting-text">
					<p>I have this for all four directions, this is for the Up botton:</p><p>&#xA0; LDA $0200&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ; load sprite Y position<br>&#xA0; SEC&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ; make sure the carry flag is clear<br>&#xA0; SBC #Speed&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ; A = A +&#xA0;the variable&#xA0;&#xA0;<br>&#xA0; STA $0200</p><p>&#xA0; JSR transfer_nightman_info ;transfers the $0200 and $0203 into the variables</p><p>&#xA0; JSR top_wall_collision&#xA0;&#xA0; ;checks to see if he has hit the top wall, then sends it to the various room detections</p><p>&#xA0; LDA #room_change&#xA0;&#xA0;&#xA0; ;for room changes skip the next part<br>&#xA0; BEQ AnimationupCounter</p><p>&#xA0; JSR update_nightman_sprites</p><p>top_wall_collision:&#xA0;&#xA0;&#xA0; ; This is for all four directions</p><p>&#xA0; LDY #$00<br>&#xA0; STY room_change </p><p>&#xA0; LDA sprite_vertical<br>&#xA0; CMP #top_wall&#xA0;&#xA0;&#xA0; ;check location<br>&#xA0; BCS .done&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;jump to code for inside the L/R door frames</p><p>&#xA0; LDX door_status&#xA0; ;see if the doors are open<br>&#xA0; CPX #$01<br>&#xA0; BEQ .doorclosed&#xA0; ;either jump to the top wall collsion or enter the door</p><p>&#xA0; TAY<br>&#xA0; LDA banks_and_doors&#xA0;&#xA0;&#xA0; ;enter the door/active room switching<br>&#xA0; AND #%10000000&#xA0;&#xA0; ;see if there is a door in this direction<br>&#xA0; BEQ .doorclosed</p><p>&#xA0; LDX sprite_horizontal&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;see if he is in the door frame<br>&#xA0; CPX #vertical_door_right+2<br>&#xA0; BCS .doorclosed<br>&#xA0; CPX #vertical_door_left-2<br>&#xA0; BCC .doorclosed<br>&#xA0; <br>&#xA0; LDX #vertical_door_left+2&#xA0;&#xA0;&#xA0; ;this is so the dumb ass doesn&apos;t run into said door frame.<br>&#xA0; STX sprite_horizontal</p><p>&#xA0; TYA<br>&#xA0; CMP #top_exit&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;see if he is at the top yet<br>&#xA0; BCS .done2<br>&#xA0; <br>&#xA0; JSR exit_on_top<br>&#xA0; LDY #$01<br>&#xA0; STY room_change<br>&#xA0; RTS</p><p>.doorclosed:<br>&#xA0; LDA #top_wall&#xA0;&#xA0; ;if the door is closed or outside the frame, stay below the wall<br>&#xA0; STA sprite_vertical<br>&#xA0; JSR direction_change<br>&#xA0; JMP .done2</p><p>.done&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;doors open routine<br>&#xA0; LDX door_status&#xA0; ;see if the doors are open<br>&#xA0; CPX #$01<br>&#xA0; BEQ .done1</p><p>&#xA0; CMP #horizontal_door_top&#xA0;&#xA0;&#xA0; ;this is for if he is in the door frame<br>&#xA0; BCS .done1&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;see if he is at the top of the door</p><p>&#xA0; LDX sprite_horizontal&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;check left<br>&#xA0; CPX #left_wall<br>&#xA0; BCC .next</p><p>&#xA0; CPX #right_wall+1&#xA0;&#xA0;&#xA0;&#xA0; ;check right<br>&#xA0; BCC .done1<br>&#xA0; <br>.next<br>&#xA0; LDA #horizontal_door_top&#xA0; ;stay in the door frame<br>&#xA0; STA sprite_vertical<br>&#xA0; JMP .done2&#xA0; </p><p>.done1&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;load info for which direction to use<br>&#xA0; LDX #$00<br>&#xA0; STX collide_direction<br>&#xA0; JSR collision_detection&#xA0; ;indirect jump to collision detection<br>&#xA0; <br>.done2<br>&#xA0; RTS</p><p>collision_detection:&#xA0;&#xA0; ;indirect jumping for collision detection<br>&#xA0; JMP [collideptr]&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0;&#xA0; ;the collideptr is set to collide0 in the room loading routine</p><p>collision0:<br>&#xA0; .word up_collide0,down_collide0,right_collide0,left_collide0</p><p>collide0:<br>&#xA0; LDX collide_direction&#xA0; ;$00=up, $02=down, $04=right, $06=left<br>&#xA0; LDY collision0,X<br>&#xA0; STY collideptr2<br>&#xA0; LDY collision0+1,X<br>&#xA0; STY collideptr2+1</p><p>&#xA0; JMP [collideptr2]</p><p>up_collide0:</p><p>&#xA0; LDA sprite_vertical<br>&#xA0; LDX sprite_horizontal&#xA0; ;top pipe on right side of the screen<br>&#xA0; CPX #$7F<br>&#xA0; BCC .done<br>&#xA0; CPX #$C8<br>&#xA0; BCS .done<br>&#xA0; CMP #$70<br>&#xA0; BCC .done<br>&#xA0; CMP #$78<br>&#xA0; BCS .done<br>&#xA0; LDA #$78<br>&#xA0; STA sprite_vertical<br>&#xA0; JSR direction_change<br>&#xA0; JMP .dones</p><p>.done<br>&#xA0; CPX #$68&#xA0; ; bottom of the engine<br>&#xA0; BCS .done1<br>&#xA0; CMP #$AF<br>&#xA0; BCS .done1<br>&#xA0; CMP #$A0<br>&#xA0; BCC .done1<br>&#xA0; LDA #$AF<br>&#xA0; STA sprite_vertical<br>&#xA0; JSR direction_change<br>&#xA0; JMP .dones</p><p>.done1<br>&#xA0; CPX #$78&#xA0; ;very top piece of pipe<br>&#xA0; BCS .done2<br>&#xA0; CMP #$67<br>&#xA0; BCS .done2<br>&#xA0; LDA #$67<br>&#xA0; STA sprite_vertical<br>&#xA0; JSR direction_change<br>&#xA0; JMP .dones</p><p>.done2<br>&#xA0; CPX #$7F&#xA0; ;bottom pipe on right side of the screen<br>&#xA0; BCC .done3<br>&#xA0; CPX #$C8<br>&#xA0; BCS .done3<br>&#xA0; CMP #$B0<br>&#xA0; BCC .done3<br>&#xA0; CMP #$B8<br>&#xA0; BCS .done3<br>&#xA0; LDA #$B8<br>&#xA0; STA sprite_vertical<br>&#xA0; JSR direction_change<br>&#xA0; JMP .dones</p><p>.done3<br>&#xA0; CPX #$68&#xA0; ;get around the top corner of the engine<br>&#xA0; BCC .done4<br>&#xA0; CPX #$6E<br>&#xA0; BCS .done4<br>&#xA0; CMP #$A7<br>&#xA0; BCC .done4<br>&#xA0; CMP #$AE<br>&#xA0; BCS .done4<br>&#xA0; INC sprite_horizontal<br>&#xA0; JMP .dones </p><p>.done4<br>&#xA0; CPX #$C8<br>&#xA0; BCC .done5<br>&#xA0; CPX #$CE<br>&#xA0; BCS .done5<br>&#xA0; CMP #$6D&#xA0; ;Get around the top pipe tip.<br>&#xA0; BCC .next<br>&#xA0; CMP #$78<br>&#xA0; BCC .next1<br>.next<br>&#xA0; CMP #$AD&#xA0; ;get around the bottom pipe tip<br>&#xA0; BCC .done5<br>&#xA0; CMP #$B8<br>&#xA0; BCS .done5<br>.next1<br>&#xA0; INC sprite_horizontal<br>&#xA0; JMP .dones</p><p>.done5<br>&#xA0; CMP #$68&#xA0;&#xA0;&#xA0; ;move around the top elbow<br>&#xA0; BCC .done6<br>&#xA0; CMP #$78<br>&#xA0; BCS .done6<br>&#xA0; CPX #$74<br>&#xA0; BCC .done6<br>&#xA0; CPX #$80<br>&#xA0; BCS .done6<br>&#xA0; DEC sprite_horizontal<br>&#xA0; JMP .dones</p><p>.done6<br>.dones<br>&#xA0; RTS</p>
				</div><div class="mdl-card--border"></div>