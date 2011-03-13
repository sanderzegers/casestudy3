		<div id="content_left">
			<div id="content_left2">
				<div id="content_left3">
				<?php 
					$last = 0;
					foreach ($menu as $a){
						
						if($a["class"] == "1"){
							if ($last == 2){
								echo '</p>'."\n";
							}
							if ($last == 1){
								echo '<br>'."\n";
							}
							echo '<p id="text_content" class="level1l">'."\n";
							if ($a["amount"])
								echo '<a href="'.site_url('/show/category/'.$a["id"]).'">'.$a["name"].'</a><br>'."\n";
							else
								echo $a["name"].'</a><br>'."\n";
						}
						if($a["class"] == "2"){
							if ($last != 2){
								echo '<p id="text_content" class="level2l">'."\n";
							}
							echo '<a href="'.site_url('/show/category/'.$a["id"]).'">'.$a["name"].'</a><br>'."\n";
						}
						$last = $a["class"];
					}
					?>
					<br><br><br>
				</div>
			</div>
		</div>
