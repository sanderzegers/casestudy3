		<div id="content_left">
			<div id="content_left2">
				<div id="content_left3">
					
					<!-- TODO: Soviel Code wie möglich in den Controller! -->
					<?php 
					$last = 0;
					foreach ($menu as $a){
						
						if($a[1] == "1"){
							if ($last == 2){
								echo '</p>'."\n";
							}
							if ($last == 1){
								echo '<br>'."\n";
							}
							echo '<p id="text_content" class="level1l">'.$a[0].'</p>'."\n";
						}
						if($a[1] == "2"){
							if ($last != 2){
								echo '<p id="text_content" class="level2l">'."\n";
							}
							echo '<a href="'.site_url('/show/category/'.$a[2]).'">'.$a[0].'</a><br>'."\n";
						}
						$last = $a[1];
					}
					?>
					<br><br><br>
				</div>
			</div>
		</div>
