<?php

ob_start();
?>
<div id="mmaterial_pdf" class="<?php the_title(); ?>">
<div id="page1">
<table width="595px" height="842px">
<tbody>
<tr>
<td style="height:100%; vertical-align:central; text-align:center;"><img width="500px" alt="MMATERIAL" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-pdf.svg"></td>
</tr>
</tbody>
</table>
<pagebreak />
</div>

<div id="page2">
<?php
$counting = count(get_field('product_variation_image'));
if ( ($counting % 2 )== 0 ) {  

		$image_size = "thumbnail"; 
		if (get_field('product_variation_image')) {
			$x=1;
			while( has_sub_field("product_variation_image") ) {
				$variation_img = get_sub_field('variation_image'); 
				$variation_info = get_sub_field('variation_short_info');  
				$image[$x] = wp_get_attachment_image( $variation_img,  array(150,150) );
				$x=$x+1;
			}
			
		} ?>
    
        <table width="595px" height="842px" border="0" cellspacing="0">
          <tbody>
          	<tr>
            	<td><?php the_title(); ?></td>
            </tr>
            <tr>
              <td rowspan="2" scope="col" width="400px"><img width="400" src="<?php the_field('hero_image'); ?>" alt="" /></td>
              <td scope="col" width="150px"><?php echo $image[1]; ?></td>
            </tr>
            <tr>
              <td width="150px"><?php echo $image[2]; ?></td>
            </tr>
          </tbody>
        </table>
<?php
} 
else { 
		$image_size = "shop_catalog"; 
		$variation_img = get_sub_field('variation_image'); 
		$variation_info = get_sub_field('variation_short_info');		
		$image = wp_get_attachment_image( $variation_img_2,  array(150,150) );		
		?>
        
        <table width="595px" height="842px" border="0" cellspacing="0">
          <tbody>
          	<tr>
            	<td><?php the_title(); ?></td>
            </tr>
            <tr>
              <td width="550px"><img width="550" src="<?php the_field('hero_image'); ?>" alt="" /></td>
            </tr>
            <tr>
              <td width="550px"><?php echo $image; ?></td>
            </tr>
          </tbody>
        </table>
<?php		
} ?>
	
<pagebreak />
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

//$build_html = get_stylesheet_directory().'/tearsheets/'.get_the_ID().'.html';


//file_put_contents( $build_html , $content_new_all );

//tearsheet($build_html);


//$html = file_get_contents($build_html);

include("mpdf60/mpdf.php");

$mpdf=new mPDF('c');  

$mpdf->WriteHTML($content_new_all);

$mpdf->Output('MMATERIAL-Tearsheet-'.get_the_ID().'.pdf','F');

?>
