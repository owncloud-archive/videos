<?php
if(empty($_['videos'])) {
	print_unescaped($this->inc('part.empty'));
} else {
	print_unescaped($this->inc('part.videos'));
}
