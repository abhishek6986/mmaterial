<?php
global $product, $woocommerce_loop;
echo "ID - ".$id =$product->ID;

ob_start();
?>
<div id="mmaterial_pdf" class="<?php the_title(); ?>">
<div id="page1">
<table width="595px" height="842px">
<tbody>
<tr>
<td style="height:100%; vertical-align:central; text-align:center;"><img alt="MMATERIAL" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg"></td>
</tr>
</tbody>
</table>
</div>

<div id="page2">
<?php
$counting = count(get_field('product_variation_image', $id));
if ( ($counting % 2 )== 0 ) {  

		$image_size = "thumbnail"; 
		if (get_field('product_variation_image',$id)) {
			$i = 1;
			while( has_sub_field("product_variation_image",$id) ) {
				$variation_img_.$i = get_sub_field('variation_image',$id); 
				$variation_info_.$i = get_sub_field('variation_short_info',$id);  
				$i++;
			}
		} ?>
    
        <table width="595px" height="842px" border="0" cellspacing="0">
          <tbody>
          	<tr>
            	<td><?php the_title(); ?></td>
            </tr>
            <tr>
              <td rowspan="2" scope="col" width="400px"><img width="400" src="<?php the_field('hero_image',$id); ?>" alt="" /></td>
              <td scope="col" width="150px"><img width="150" src="<?php echo wp_get_attachment_image( $variation_img_1,  $image_size ); ?>" alt="" /></td>
            </tr>
            <tr>
              <td width="150px"><img width="150" src="<?php echo wp_get_attachment_image( $variation_img_1,  $image_size ); ?>" alt="" /></td>
            </tr>
          </tbody>
        </table>
<?php
} 
else { 
		$image_size = "shop_catalog"; 
		$variation_img = get_sub_field('variation_image',$id); 
		$variation_info = get_sub_field('variation_short_info',$id);				
		?>
        
        <table width="595px" height="842px" border="0" cellspacing="0">
          <tbody>
          	<tr>
            	<td><?php the_title(); ?></td>
            </tr>
            <tr>
              <td width="550px"><img width="550" src="<?php the_field('hero_image',$id); ?>" alt="" /></td>
            </tr>
            <tr>
              <td width="550px"><img width="550" src="<?php echo wp_get_attachment_image( $variation_img,  $image_size ); ?>" alt="" /></td>
            </tr>
          </tbody>
        </table>
<?php		
} ?>
	

</div>

<div id="page3">
<table width="595px" height="842px">
<tbody>
<tr>
<td style="height:100%; vertical-align:bottom; text-align:center;">
<h2>M Materials</h2>
<p>46-55 Metropolitan Avenue<br/>
Suite 102<br/>
Flushing NY 11385<br/>
(By Appointment Only)</p>
<br/>
<p>General Enquiries<br/><br/></p>
<a hre="mailto:info@m-material.com" >info@m-material.com</a>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<?php

$content_new_all =  ob_get_contents();
ob_end_clean();
//var_dump($content_new_all);
 file_put_contents( 'tearsheet-template.html', $content_new_all );

?>

