<link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" /><script src="http://code.jquery.com/jquery-1.12.4.js"></script>

	<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
    /** This section is only needed once per page if manually copying **/
    if (typeof MauticSDKLoaded == 'undefined') {
        var MauticSDKLoaded = true;
        var head            = document.getElementsByTagName('head')[0];
        var script          = document.createElement('script');
        script.type         = 'text/javascript';
        script.src          = 'http://othello.genecopoeia.com/mautic/media/js/mautic-form.js';
        script.onload       = function() {
            MauticSDK.onLoad();
        };
        head.appendChild(script);
        var MauticDomain = 'http://othello.genecopoeia.com';
        var MauticLang   = {
            'submittingMessage': "Please wait..."
        }
    }
  // Other volume input radio
    function setCustomRadioAttr(){
        var value = jQuery("#amou_input_5").val();
        jQuery("#mauticform_radiogrp_radio_7_indicate_the_total_amou_custom").val(value);
        value = jQuery("#mauticform_radiogrp_radio_7_indicate_the_total_amou_custom").val();
        // console.log("the_total_amou:"+value);
    }
   function trim(str){
		return str.replace(/(^\s*)|(\s*$)/g, "");
	}
	function ltrim(str){
		return str.replace(/(^\s*)/g,"");
	}
	function rtrim(str){
		return str.replace(/(\s*$)/g,"");
	}
	function checkForm(){
		if(!jQuery("input[name='mauticform[7_indicate_the_total_amou]']:checked").val()){
			var msg = "Please specify volme and titer if you check \"other volume\" in No.8 !";
		}
    	if(!jQuery("input[name='mauticform[7_indicate_the_total_amou]']").is(':checked')){
    		var msg = "No.9 is required !";
	    }
		if(!jQuery("input[name='mauticform[6_do_you_plan_to_use_aav]']").is(':checked')){
    		var msg = "No.8 is required !";
	    }
	    if(!jQuery("input[name='mauticform[6_indicate_the_reporter_g]']").is(':checked')){
    		var msg = "No.7 is required !";
	    }
	    if(!jQuery("input[name='mauticform[5_indicate_the_promoter_f]']").is(':checked')){
    		var msg = "No.6 is required !";
	    }
	    if(!jQuery("input[name='mauticform[4_indicate_the_serotype_f]']").is(':checked')){
    		var msg = "No.5 is required !";
	    }
	    if(!trim(jQuery("input[name='mauticform[3_enter_the_identificatio]']").val())){
    		var msg = "No.4 is required !";
	    }
	    if(!jQuery("input[name='mauticform[3_you_choice_of_species]']").is(':checked')){
    		var msg = "No.3 is required !";
	    }
	    if(!jQuery("input[name='mauticform[2_what_is_the_adenoassoci]']").is(':checked')){
    		var msg = "No.2 is required !";
	    }
	    if(!trim(jQuery("input[name='mauticform[telephone]']").val())){
    		var msg = "Telephone is required !";
	    }
            if(!trim(jQuery("input[name='mauticform[email]']").val())){
    		var msg = "Email is required !";
	    }
	    if(!trim(jQuery("input[name='mauticform[institution]']").val())){
    		var msg = "Institution is required !";
	    }
	    if(!trim(jQuery("input[name='mauticform[name]']").val())){
    		var msg = "Name is required !";
    	}
	    if(msg){
	    	jQuery("#dialog").text(msg);
		    jQuery("#dialog").dialog("open");
		    return false;
	    } else{
	    	return true;
	    }
    }

    

	jQuery(document).ready(function($){ 
		jQuery("#dialog").dialog({ autoOpen: false, modal: true });
        jQuery("input[type='image']").click(function(){
            jQuery("#mauticform_wrapper_customadenoassociatedvirusproductionservices").submit();
        });
        //Click gRNA only / CRISPR all-in-one No.2
        var nodeNofive = jQuery("#mauticform_customadenoassociatedvirusproductionservices_5_indicate_the_promoter_f>div").clone(true);
        var nodeNosix = jQuery("#mauticform_customadenoassociatedvirusproductionservices_6_indicate_the_reporter_g").clone(true);
        jQuery("#sgRNAcheckBoxes .mauticform-radiogrp-radio").bind("click",function(){
    		var strnode = '<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_U6" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="U6" /><span style="padding:0 0 0 4px;"> U6 </span></div>'+"\r\n";
    		// 创建信息问题节点
    		var strnode2 = '<div class="mauticform-row mauticform-radiogrp mauticform-required"  data-validate="6_indicate_the_reporter_g" data-validation-type="radiogrp" id="mauticform_customadenoassociatedvirusproductionservices_6_indicate_the_reporter_g"><span style="font-weight:bold">7. Indicate the Cas9 for your sgRNA working with<span style="color:red;">*</span><div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" name="mauticform[6_indicate_the_reporter_g]" type="radio" value="SpCas9" /><span style="padding:0 10px 0 4px;">SpCas9</span><input class="mauticform-radiogrp-radio" name="mauticform[6_indicate_the_reporter_g]" type="radio" value="SaCas9" /><span style="padding:0 10px 0 4px;">SaCas9</span><input class="mauticform-radiogrp-radio" name="mauticform[6_indicate_the_reporter_g]" type="radio" value="Cas9HF" /><span style="padding:0 10px 0 4px;">Cas9HF</span></div><p>&nbsp;</p></div>'+"\r\n";

    		if(jQuery(this).is(":checked")){
    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_5_indicate_the_promoter_f").children("div").remove();
    			var count=0;
	    		jQuery("#sgRNAcheckBoxes .mauticform-radiogrp-radio").each(function(){
	    			if(jQuery(this).is(":checked")) count++;
	    		});
	    		if(jQuery(this).val()=="ORF"){
	    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_5_indicate_the_promoter_f").children('p').before(nodeNofive);
	    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_6_indicate_the_reporter_g").remove();
	    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_6_do_you_plan_to_use_aav").before(nodeNosix);
	    		}else{
	    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_5_indicate_the_promoter_f").children('p').before(strnode);
	    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_6_indicate_the_reporter_g").replaceWith(strnode2);
	    		}
    		}else{
    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_5_indicate_the_promoter_f").children("div").remove();
    			var count=0;
	    		jQuery("#sgRNAcheckBoxes .mauticform-radiogrp-radio").each(function(){
	    			if(jQuery(this).is(":checked")) count++;
	    		});
	    		
	    		if(jQuery(this).val()=="ORF"){
	    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_5_indicate_the_promoter_f").children('p').before(nodeNofive);
	    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_6_indicate_the_reporter_g").remove();
	    			jQuery("#mauticform_customadenoassociatedvirusproductionservices_6_do_you_plan_to_use_aav").before(nodeNosix);
	    		}
    		}

    		
    	});
        //Click No.6
        // jQuery("input[name='mauticform[6_do_you_plan_to_use_aav]']").click(function(){
        //     var no6_val = jQuery("input[name='mauticform[6_do_you_plan_to_use_aav]']:checked").val();
        //     if(no6_val == "No"){
        //         jQuery(".for_human").show();
        //         jQuery(".for_animal").hide();
		      //   jQuery(".for_animal input[type=radio]").attr("checked",false);
        //     } else{
        //         jQuery(".for_animal").show();
        //         jQuery(".for_human").hide();
	       //  jQuery(".for_human input[type=radio]").attr("checked",false);
        //     }
        // });
        // Click No.7 input radio
        jQuery("#mauticform_radiogrp_radio_7_indicate_the_total_amou_custom").click(function(){
            jQuery("#amou_input_5").focus();
        });
        // Click No.8 input text
        jQuery("#amou_input_5").focus(function(){
			jQuery("#mauticform_radiogrp_radio_7_indicate_the_total_amou_custom").attr("checked","checked");
		});
        //Validate
        jQuery("#mauticform_wrapper_customadenoassociatedvirusproductionservices").submit(function(){
		    if(checkForm()){  
		        return true;  
		    }else{  
		        return false;  
		    }  
		});  
    });
</script>

<p>&nbsp;</p>
<style scoped="" type="text/css">.mauticform_wrapper {}
    .mauticform-innerform {}
    .mauticform-post-success {}
    .mauticform-name { font-weight: bold; font-size: 1.5em; margin-bottom: 3px; }
    .mauticform-description { margin-top: 2px; margin-bottom: 10px; }
    .mauticform-error { margin-bottom: 10px; color: red; }
    .mauticform-message { margin-bottom: 10px;color: green; }
    .mauticform-row { display: block; margin-bottom: 20px; }
    .mauticform-label { font-size: 1.1em; display: block; font-weight: bold; margin-bottom: 5px; }
    .mauticform-row.mauticform-required .mauticform-label:after { color: #e32; content: " *"; display: inline; }
    .mauticform-helpmessage { display: block; font-size: 0.9em; margin-bottom: 3px; }
    .mauticform-errormsg { display: inline; color: red; margin-top: 2px; }
    .mauticform-selectbox, .mauticform-textarea { width: 613px; height: 100px;}
    .mauticform-input { height:15px;/* width: 35%; padding: 0.2em 0.2em; border: 1px solid #CCC; box-shadow: 0px 1px 3px #DDD inset; border-radius: 4px;*/  }
    .mauticform-checkboxgrp-row {}
    .mauticform-checkboxgrp-label { font-weight: normal; }
    .mauticform-checkboxgrp-checkbox {}
    .mauticform-radiogrp-row {}
    .mauticform-radiogrp-label { font-weight: normal; {
    .mauticform-radiogrp-radio {}</style>
<div id="dialog" style="display:none" title="Note this:">&nbsp;</div>

<p>Custom adeno-associated virus particle production is offered for human and mouse ORFs. GeneCopoeia also offers <a href="http://www.genecopoeia.com/product/aavprime-adeno-associated-virus-particles/">pre-made AAV particles </a> carrying various genes and promoters.</p>

<p style="color:red;">* Required fields</p>

<p><span style="font-weight:bold">1. Contact information </span></p>

<div class="mauticform_wrapper" id="mauticform_wrapper_customadenoassociatedvirusproductionservices">
	<form action="http://othello.genecopoeia.com/mautic/index.php/form/submit?formId=8" autocomplete="false" data-mautic-form="customadenoassociatedvirusproductionservices" id="mauticform_customadenoassociatedvirusproductionservices" method="post" role="form">
		<div class="mauticform-innerform">
			<table>
				<tbody>
					<tr>
						<td style="width:100px;height:30px;vertical-align:middle;">Name:</td>
						<td style="height:30px;vertical-align:middle;">
							<div class="mauticform-row mauticform-text mauticform-required" data-validate="name" data-validation-type="text" id="mauticform_customadenoassociatedvirusproductionservices_name" style="display: inline;"><input class="mauticform-input" id="mauticform_input_customadenoassociatedvirusproductionservices_name" name="mauticform[name]" style="width: 160px;" type="text" value="" /><span style="color:red;"> * </span> <span class="mauticform-errormsg" style="display: none;"><img alt="This Field Empty" border="0" src="../images/stop.jpg" /> (This Field Request ! ) </span></div>
						</td>
					</tr>
					<tr>
						<td style="width:100px;height:30px;vertical-align:middle;">Institution:</td>
						<td style="height:30px;vertical-align:middle;">
							<div class="mauticform-row mauticform-text mauticform-required" data-validate="institution" data-validation-type="text" id="mauticform_customadenoassociatedvirusproductionservices_institution" style="display: inline;"><input class="mauticform-input" id="mauticform_input_customadenoassociatedvirusproductionservices_institution" name="mauticform[institution]" style="width: 160px;" type="text" value="" /> <span style="color:red;"> * </span><span class="mauticform-errormsg" style="display: none;"><img alt="This Field Empty" border="0" src="../images/stop.jpg" /> (This Field Request ! ) </span></div>
						</td>
					</tr>
					<tr>
						<td style="width:100px;height:30px;vertical-align:middle;">Institution e-mail:</td>
						<td style="height:30px;vertical-align:middle;">
							<div class="mauticform-row mauticform-email mauticform-required" data-validate="email" data-validation-type="email" id="mauticform_customadenoassociatedvirusproductionservices_email" style="display: inline;"><input class="mauticform-input" id="mauticform_input_customadenoassociatedvirusproductionservices_email" name="mauticform[email]" style="width: 160px;" type="email" value="" /><span style="color:red;"> * </span> <span class="mauticform-errormsg" style="display: none;"><img alt="This Field Empty" border="0" src="../images/stop.jpg" /> (This Field Request ! ) </span></div>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style="vertical-align:middle;"><input class="mauticform-checkboxgrp-checkbox" id="mauticform_checkboxgrp_checkbox_please_check_if_you_do_no_PleasecheckifyouDoNotwishtoreceivepromotionandnewproductinformation" name="mauticform[please_check_if_you_do_no][]" type="checkbox" value="No" />Please check if you DO NOT wish to receive promotional and new product information</td>
					</tr>
					<tr>
						<td style="width:100px;height:30px;vertical-align:middle;">Telephone:</td>
						<td style="height:30px;vertical-align:middle;">
							<div class="mauticform-row mauticform-tel mauticform-required" data-validate="telephone" data-validation-type="tel" id="mauticform_customadenoassociatedvirusproductionservices_telephone" style="display: inline;"><input class="mauticform-input" id="mauticform_input_customadenoassociatedvirusproductionservices_telephone" name="mauticform[telephone]" style="width: 160px;" type="tel" value="" /><span style="color:red;"> * </span><span class="mauticform-errormsg" style="display: none;"><img alt="This Field Empty" border="0" src="../images/stop.jpg" /> (This Field Request ! ) </span></div>
						</td>
					</tr>
				</tbody>
			</table>

			<p>&nbsp;</p>

			<div class="mauticform-row mauticform-radiogrp mauticform-required" data-validate="2_what_is_the_adenoassoci" data-validation-type="radiogrp" id="mauticform_customadenoassociatedvirusproductionservices_2_what_is_the_adenoassoci"><span style="font-weight:bold;">2. What is the adeno-associated virus (AAV) for? </span><span style="color:red;"> *</span>

				<div class="mauticform-radiogrp-row" id="sgRNAcheckBoxes" style="padding:2px 0;">
					<input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_2_what_is_the_adenoassoci_HumansgRNA" name="mauticform[2_what_is_the_adenoassoci]" type="radio" value="ORF" /><span style="padding:0 30px 0 4px;"> ORF &nbsp; </span><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_2_what_is_the_adenoassoci_MousesgRNA" name="mauticform[2_what_is_the_adenoassoci]" type="radio" value="sgRNA only" /><span style="padding:0 30px 0 4px;"> sgRNA only </span><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_2_what_is_the_adenoassoci_RatsgRNA" name="mauticform[2_what_is_the_adenoassoci]" type="radio" value="CRISPR all-in-one (SaCas9 and sgRNA)" /><span style="padding:0 30px 0 4px;"> CRISPR all-in-one (SaCas9 and sgRNA) </span>
				</div>

				<p>&nbsp;</p>
			</div>

			<div class="mauticform-row mauticform-radiogrp mauticform-required" data-validate="3_you_choice_of_species" data-validation-type="radiogrp" id="mauticform_customadenoassociatedvirusproductionservices_3_you_choice_of_species"><span style="font-weight:bold;">3. Your choice of species </span><span style="color:red;"> *</span>

				<div class="mauticform-radiogrp-row" id="sgRNAcheckBoxes" style="padding:2px 0;">
					<input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_3_you_choice_of_species" name="mauticform[3_you_choice_of_species]" type="radio" value="human" />
					<span style="padding:0 30px 0 4px;"> human &nbsp; </span>
					<input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_3_you_choice_of_species" name="mauticform[3_you_choice_of_species]" type="radio" value="mouse" />
					<span style="padding:0 30px 0 4px;"> mouse</span>
				</div>

				<p>&nbsp;</p>
			</div>

			<div class="mauticform-row mauticform-text mauticform-required" data-validate="3_enter_the_identificatio" data-validation-type="text" id="mauticform_customadenoassociatedvirusproductionservices_3_enter_the_identificatio"><span style="font-weight:bold;">4. Enter your gene information,</span> i.e. accession number (preferred), gene ID or gene symbol<br />
				<input class="mauticform-input" id="mauticform_input_customadenoassociatedvirusproductionservices_3_enter_the_identificatio" name="mauticform[3_enter_the_identificatio]" style="width: 160px;" type="text" value="" /><span style="color:red"> * </span> <span class="mauticform-errormsg" style="display: none;"><img alt="This Field Empty" border="0" src="../images/stop.jpg" /> (This Field Request ! ) </span><br />
				<span style="color:red;">(Please note that genes longer than 3kb cannot be packaged into AAV particles) </span></div>

			<div class="mauticform-row mauticform-radiogrp mauticform-required" data-validate="4_indicate_the_serotype_f" data-validation-type="radiogrp" id="mauticform_customadenoassociatedvirusproductionservices_4_indicate_the_serotype_f"><span style="font-weight:bold;">5. Indicate the serotype for your AAV particles</span><span style="color:red"> *</span>

				

				<div class="mauticform-radiogrp-row"><input class="mauticform-radiogrp-radio" id="AAV-1" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-1" /><span style="padding:0 0 0 4px;"> AAV-1 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-2" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-2" /> <span style="padding:0 0 0 4px;">AAV-2 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-3" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-3" /> <span style="padding:0 0 0 4px;">AAV-3 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-4" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-4" /> <span style="padding:0 0 0 4px;">AAV-4 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-5" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-5" /> <span style="padding:0 0 0 4px;">AAV-5 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-6" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-6" /> <span style="padding:0 0 0 4px;">AAV-6 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-7" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-7" /> <span style="padding:0 0 0 4px;">AAV-7 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-8" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-8" /> <span style="padding:0 0 0 4px;">AAV-8 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-9" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-9" /> <span style="padding:0 0 0 4px;">AAV-9 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-10" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-10" /> <span style="padding:0 0 0 4px;">AAV-10 </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-DJ" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-DJ" /> <span style="padding:0 0 0 4px;">AAV-DJ </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="AAV-DJ/8" name="mauticform[4_indicate_the_serotype_f]" type="radio" value="AAV-DJ/8" /> <span style="padding:0 0 0 4px;">AAV-DJ/8 </span></div>

				<p>&nbsp;</p>

				
			</div>

			<div class="mauticform-row mauticform-radiogrp mauticform-required" data-validate="5_indicate_the_promoter_f" data-validation-type="radiogrp" id="mauticform_customadenoassociatedvirusproductionservices_5_indicate_the_promoter_f"><span style="font-weight:bold;">6. Indicate the promoter for your gene of interest</span><span style="color:red;"> *</span>

				

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_CMV" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="CMV" /><span style="padding:0 0 0 4px;"> CMV </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_EF1" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="EF-1¦Á" /><span style="padding:0 0 0 4px;"> EF-1&alpha; </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_CAG" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="CAG" /><span style="padding:0 0 0 4px;"> CAG </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_CAG" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="CBH" /><span style="padding:0 0 0 4px;"> CBH </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;display:none;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_Tet3GInducible" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="TRE3 (Inducible)" /><span style="padding:0 0 0 4px;"> TRE3 (Inducible) </span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_CAMKlla" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="CAMKlla" /><span style="padding:0 0 0 4px;">CAMKlla</span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_hSYN" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="hSYN" /><span style="padding:0 0 0 4px;">hSYN</span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_5_indicate_the_promoter_f_MHC" name="mauticform[5_indicate_the_promoter_f]" type="radio" value="MHC" /><span style="padding:0 0 0 4px;">MHC</span></div>

				

				<p>&nbsp;</p>
			</div>

			<div class="mauticform-row mauticform-radiogrp mauticform-required" data-validate="6_indicate_the_reporter_g" data-validation-type="radiogrp" id="mauticform_customadenoassociatedvirusproductionservices_6_indicate_the_reporter_g"><span style="font-weight:bold">7. Indicate the reporter gene for your gene of interest </span><span style="color:red;"> *</span>

				

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" name="mauticform[6_indicate_the_reporter_g]" type="radio" value="None" /><span style="padding:0 0 0 4px;">None</span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" name="mauticform[6_indicate_the_reporter_g]" type="radio" value="IRES-eGFP" /><span style="padding:0 0 0 4px;">IRES-eGFP</span></div>

				

				<p>&nbsp;</p>
			</div>

			<div class="mauticform-row mauticform-radiogrp mauticform-required" data-validate="6_do_you_plan_to_use_aav" data-validation-type="radiogrp" id="mauticform_customadenoassociatedvirusproductionservices_6_do_you_plan_to_use_aav"><span style="font-weight:bold"><span class="NoChange">8</span>. Do you plan to use AAV particles for animals (<i>in vivo</i>)? </span><span style="color:red;"> *</span>

				

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="yes" name="mauticform[6_do_you_plan_to_use_aav]" type="radio" value="Yes" /><span style="padding:0 0 0 4px;">Yes</span></div>

				<div class="mauticform-radiogrp-row" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="no" name="mauticform[6_do_you_plan_to_use_aav]" type="radio" value="No" /><span style="padding:0 0 0 4px;">No</span></div>

				

				<p>&nbsp;</p>
			</div>

			<div class="mauticform-row mauticform-radiogrp mauticform-required" data-validate="7_indicate_the_total_amou" data-validation-type="radiogrp" id="mauticform_customadenoassociatedvirusproductionservices_7_indicate_the_total_amou"><span style="font-weight:bold;"><span class="NoChange">9</span>. Indicate the total volume you need </span><span style="color:red"> *</span>

				

				<div class="mauticform-radiogrp-row for_animal" id="amou_radio_1" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="200ul" name="mauticform[7_indicate_the_total_amou]" type="radio" value="200ul (Titer ≥ 5x10^12 GC/ml)" /><span style="padding:0 0 0 4px;">200ul (Titer &ge; 5x10^12 GC/ml)</span></div>

				<div class="mauticform-radiogrp-row for_animal" id="amou_radio_2" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="400ul" name="mauticform[7_indicate_the_total_amou]" type="radio" value="400ul (Titer ≥ 5x10^12 GC/ml)" /><span style="padding:0 0 0 4px;">400ul (Titer &ge; 5x10^12 GC/ml)</span></div>

				<div class="mauticform-radiogrp-row for_animal" id="amou_radio_3" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="1ml" name="mauticform[7_indicate_the_total_amou]" type="radio" value="1ml (Titer ≥ 5x10^12 GC/ml)" /><span style="padding:0 0 0 4px;">1ml (Titer &ge; 5x10^12 GC/ml) </span></div>

				
				<div class="mauticform-radiogrp-row" id="amou_radio_5" style="padding:2px 0;"><input class="mauticform-radiogrp-radio" id="mauticform_radiogrp_radio_7_indicate_the_total_amou_custom" name="mauticform[7_indicate_the_total_amou]" type="radio" value="" /><span style="padding:0 0 0 4px;">Other volume <input class="mauticform-input" id="amou_input_5" onblur="setCustomRadioAttr();" style="width: 180px;" type="text" value="" /><span style="margin-left:5px;">( Please specify volme and titer )</span></span></div>

				

				<p>&nbsp;</p>
			</div>

			<div class="mauticform-row mauticform-text" id="mauticform_customadenoassociatedvirusproductionservices_8_special_requirements_an1"><span style="font-weight:bold;"><span class="NoChange">10</span>. Special requirements and comments </span><textarea class="mauticform-textarea" id="mauticform_input_customadenoassociatedvirusproductionservices_8_special_requirements_an1" name="mauticform[8_special_requirements_an1]"></textarea> <span class="mauticform-errormsg" style="display: none;"> </span></div>

			<div class="mauticform-row mauticform-text"><span style="font-weight:bold;"><span class="NoChange">11</span>. Need more help? Please contact us at</span>

				

				<table>
					<tbody>
						<tr>
							<td width="50px"><span style="font-weight:bold;">Email:</span></td>
							<td><a href="mailto:inquiry@genecopoeia.com">inquiry@genecopoeia.com </a></td>
						</tr>
						<tr>
							<td width="50px"><span style="font-weight:bold;">Call:</span></td>
							<td>866-360-9531 or 301-762-0888</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="mauticform-row mauticform-button-wrapper" id="mauticform_customadenoassociatedvirusproductionservices_submit"><button class="mauticform-button" id="mauticform_input_customadenoassociatedvirusproductionservices_submit" name="mauticform[submit]" style="display: none;" type="submit" value="1">Submit</button><input border="0" src="/images/submit.gif" type="image" /></div>

			<p><input id="mauticform_customadenoassociatedvirusproductionservices_id" name="mauticform[formId]" type="hidden" value="8" /> <input id="mauticform_customadenoassociatedvirusproductionservices_return" name="mauticform[return]" type="hidden" value="" /> <input id="mauticform_customadenoassociatedvirusproductionservices_name" name="mauticform[formName]" type="hidden" value="customadenoassociatedvirusproductionservices" /></p>

			
		</div>

		<p>&nbsp;</p>
	</form>
</div>

<div id="dialog-modal" style="display:none;" title="Note">
	<p style="font-weight:bold;">Your browser version is too low. Please upgrade or use the Chrome browser to ensure that the form is submitted properly.</p>
</div>
