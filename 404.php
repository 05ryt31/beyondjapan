<?php get_header();?>
<div class="reset">
<section class="page404-sec01">
	<div class="page404-sec01-block">
        <div class="container">
            <p class="page404-sec01-block-lead">お探しのページが見つかりませんでした。<br>
            URLが正しく入力されていない可能性が<br class="view-sp">ありますので、再度ご確認ください。</p>
            <div class="com-btn white"><p class="mask"><a href="<?php echo home_url('/'); ?>"><span>トップページへ戻る</span></a></p></div>
        </div>
	</div>
</section>
<?php get_template_part( 'temp/_cv-contact' ); ?>
<?php get_template_part( 'temp/_cv-resources' ); ?>
</div>
<?php get_footer(); ?>
