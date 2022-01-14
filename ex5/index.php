<?php
// Ссылка на видео
$url = "https://www.youtube.com/watch?v=rTEbIruSZwM";

$apiKey = "AIzaSyBMdNCjTPUlpQ1qzs_Cfo3B2AQAYSnvlIo";

$videoId = getVideoId($url);

$info = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id={$videoId}&key={$apiKey}");

$info = json_decode($info, true);
$title = $info["items"][0]["snippet"]["title"];
$image = $info["items"][0]["snippet"]["thumbnails"]["medium"]["url"];
$channelTitle = $info["items"][0]["snippet"]["channelTitle"];
$channelUrl = "https://www.youtube.com/channel/" . $info["items"][0]["snippet"]["channelId"];
	
	/**
	 * Парсинг ссылки, получение id видео.
	 * 
	 * @return String
	 */
	function getVideoId($url)
	{
		 preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
		 return $matches[0];
	}
?>

<div class="youtube__priview">
	<div class="youtube__priview-logo preview__link">
		<a href="https://www.youtube.com">
			YouTube
		</a>
	</div>
	<div class="youtube__priview-chanel preview__link">
		<a href="<?php echo $channelUrl ?>">
			<?php echo $channelTitle; ?>
		</a>
	</div>
	<div class="youtube__priview-title preview__link">
		<a href="<?php echo $url ?>">
			<?php echo $title; ?>
		</a>
	</div>
	<div class="youtube__priview-content">
		<div class="youtube__priview-content_bg">
			<img src="
			<?php echo $image
			?>
			" alt="" class="youtube__priview-img">
			<img class="sta__button" src="youtube.png" height ="70px" alt="">
		</div>
		<iframe id="preview" source="https://www.youtube.com/embed/rTEbIruSZwM?autoplay=1" frameborder="0"  allowfullscreen class="player"></iframe>
	</div>
	
</div> 

<script>
	var button = document.querySelector(".youtube__priview-content_bg");
	var iframe = document.querySelector("#preview");

	// Скрытие превью и запуск плеера.
	button.addEventListener("click", function() {
		iframe.style.display = 'block';
		iframe.setAttribute('src', 'https://www.youtube.com/embed/rTEbIruSZwM?autoplay=1');
		button.style.display = 'none';
	});
</script>

<style>
body
{
	background: #363940;
}
a
{
	text-decoration: none;
}
.player
{
	width: 320px;
	height: 180px;
}
*
{
	font-family: Calibri;
}
.preview__link
{
	margin-bottom: 5px;
}
.preview__link:hover 
{
	cursor: pointer;
}
.youtube__priview
{
	background: #303136;
	width: 320px;
	padding: 10px 20px 15px 16px;
	border-left: 4px solid #eb0808;
	border-radius: 3px;
	display: flex;
	flex-direction: column;
	margin: auto;
	margin-top: 200px;
}
.youtube__priview-logo a
{
	font-size: 15px;
	color: gray;
}
.youtube__priview-chanel a
{
	font-size: 16px;
	color: #fff;
}
.youtube__priview-title
{
	font-size: 19px;
	height: 24px;
	width: 320px;
	overflow: hidden;
	font-weight: bold;
	margin-bottom: 10px;
}
.youtube__priview-title a
{
	color: #4196DF;
}
.youtube__priview-content
{
	position: relative;
	min-height: 185px;
	cursor: pointer;
}
.youtube__priview-img
{
	position: absolute;
}
.sta__button
{
	position: absolute;
	width: 70px;
	margin: auto;
	opacity: 0.75;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
}
#preview
{
	display: none;
}
.youtube__priview-content:hover .sta__button
{
	opacity: 1;
}
</style>