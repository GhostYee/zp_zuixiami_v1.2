<?php
//翻页处理。
		$xiami_works = mysql_query("SELECT id from xiami_works WHERE status=2");
		$xiami_works_total=mysql_num_rows($xiami_works);		
		$xiami_works_pages=ceil($xiami_works_total/$home_words_step);
		if(empty($_REQUEST['page']))
		{
			$curPageNum=0;
		}
		else
		{
			$curPageNum=$_REQUEST['page'];
		}		
		$prePageNum=$curPageNum-1;
		$nextPageNum=$curPageNum+1;
		if($prePageNum<0)
		{
			$prePageNum=0;
		}
		if($nextPageNum>=$xiami_works_pages)
		{
			$nextPageNum=$xiami_works_pages-1;
		}		
		$home_words_start=$curPageNum*$home_words_step;
		$xiami_works = mysql_query("SELECT * FROM xiami_works WHERE status=2 order by rand() LIMIT ".$home_words_start .",".($home_words_step));		 		
   	?>
<div class="wgt-zpList row-fluid  ">
	<ul class="thumbnails">
	<?php while ($row = mysql_fetch_array($xiami_works)) {  ?>
		<li class="span4">
			<div class="inner">
				<div class="preview-box">
					<?php
					if($row['img']!='')
						{
					?>
					<img src="<?php echo $row['img']  ?>
					" alt="
					<?php echo $row['name']  ?>
					">
					<?php
						}
					else
						{
					?>
					<blockquote>
						<?php echo strip_tags($row['description'])  ?>
					</blockquote>
					<?php
						}
					?>
				</div>
				<a class="preview-mask" href="zpView.php?zpid=<?php echo $row['id']; ?>"></a>
				<h5>
					<a href="zpView.php?zpid=<?php echo $row['id']; ?>
						">
						<?php echo $row['name']  ?></a>
				</h5>
				<div class="info">
					<span class="author-info">
						<a href="authorView.php?userid=<?php echo $row['userid']; ?>
							" class="author-name">
							<?php echo $row['author']  ?></a>
					</span>
					<span class="opts">
						<a href="javascript:;" class="btn-like">
							<?php echo $row['good']  ?></a>
					</span>
				</div>
			</div>
		</li>
		<?php
		 }
		?></ul>
</div>
<?php 
	if($prePageNum!=$nextPageNum)
	{
?>
<div class="pagination pagination-large">
	<ul>
		<li>
			<a href="?page=<?php echo $prePageNum; ?>">«</a>
		</li>
		<li>
			<a href="?page=<?php echo $nextPageNum; ?>">»</a>
		</li>
	</ul>
</div>
<?php
	}
?>