<?php foreach($posts as $post): ?>
     
        <item>
 
          <title><?php echo xml_convert($post->judul); ?> - <?php echo idwebsite('nama_website'); ?></title>
          <link><?php echo base_url()."projects/detail/".$post->slug; ?></link>
          <guid><?php echo base_url()."projects/detail/".$post->slug; ?></guid>
 
            <description><![CDATA[ <?php echo character_limiter(strip_tags($post->content), 200); ?> ]]></description>
            <pubDate><?php echo $post->tgl_posting; ?></pubDate>
        </item> 
         
<?php endforeach; ?>