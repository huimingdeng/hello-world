<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>add_to_cart.js测试</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/add_to_cart.css" rel="stylesheet" type="text/css"/>
	<style>
		header,article{width:980px; margin:0 auto 10px auto;}
	</style>
</head>
<body>
	<main>
		<header><h1>购物车插件测试</h1></header>
		<article>
            <button type="button" class="btn btn-warning" id="c">测试</button>
            <!-- 测试非cart_add.php-->
            <form action="add_user.php" class="form-horizontal">
                <div class="form-group">
                    <label>Email:</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="pass">pass</label>
                    <input class="form-control" type="password"/>
                </div>
            </form>
			<p><h2>sgRNA/Cas9 Expression Clones and Lentiviral Particles</h2>
			sgRNA expression clones and lentiviral particles are available for targeting virtually any gene in any experimental system. sgRNA clones express either sgRNA only, or sgRNA + Cas9 nuclease in an all-in-one format. Lentiviral clones and particles express sgRNA alone. Cas9-expressing lentiviral clones and particles are available separately.</p>
			<p>The CRISPR clone options listed below are intended for using 20 nt sgRNAs with the wild-type Cas9 nuclease from Streptococcus pyogenes (SpCas9). GeneCopoeia also provides alternate CRISPR options, such as Cas9 D10A nickase and other high-fidelity versions of Cas9, SaCas9, and shorter sgRNAs. To purchase reagents for these other options, please contact us for a custom quote.</p>
			<form action="cart_add.php" method="get">
				<table>
					<tbody>
						<tr>
							<td class="row_single" nowrap="nowrap"><input name="cat_nos[]" value="LPPCCPCTR01L03-025" type="checkbox"></td>
							<td style="text-align: center;" class="row_single">LPPCCPCTR01L03-025</td>
							<td style="text-align: center;" class="row_single">Purified Lentifect&trade; Lentiviral Particles of scrambled sgRNA control CCPCTR01-LvSG03</td>
							<td style="text-align: center;" class="row_single">&gt;1×108 TU/ml sgRNA control lentiviral particles ready for transduction, 25 µL (U6/T7/mCherry/Puro)</td>
							<td style="text-align: center;" class="row_single"><a href="/wp-content/uploads/2015/04/CP-LvC9NU-03.png">pCRISPR-LvSG03</a></td>
							<td style="text-align: center;" class="row_single">$295.0</td>
						</tr>
						<tr>
							<td nowrap="nowrap"><input name="cat_nos[]" value="LPPCCPCTR01L03-100" type="checkbox"></td>
							<td style="text-align: center;">LPPCCPCTR01L03-100</td>
							<td style="text-align: center;">Purified Lentifect&trade; Lentiviral Particles of scrambled sgRNA control CCPCTR01-LvSG03</td>
							<td style="text-align: center;">&gt;1×108 TU/ml sgRNA control lentiviral particles ready for transduction, 25 µL (U6/T7/mCherry/Puro)</td>
							<td style="text-align: center;"><a href="/wp-content/uploads/2015/04/CP-LvC9NU-03.png">pCRISPR-LvSG03</a></td>
							<td style="text-align: center;">$725.0</td>
						</tr>
					</tbody>
				</table>
				<p><input name="prt" type="hidden" value="1" /></p>
				<p><input src="/images/add_t_s_c.png" type="image" border="0"></p>
			</form>
			<hr/>
			<p><h2>Secrete-Pair™ Gaussia Luciferase Dual and Single Luminescence Assay Kits</h2>
			GeneCopoeia’s Secrete-Pair™ Dual Luminescence Assay Kit is designed to analyze the activities of Gaussia Luciferase (GLuc) and Secreted Alkaline Phosphatase (SEAP) in a dual-reporter system. Both GLuc and SEAP are secreted reporter proteins, permitting detection without cell lysis. Secrete-Pair measures dual reporter signals and allows transfection normalization. A single GLuc reporter system is also available.</p>
			<p> <h2>Advantages</h2>
				<ul>
					<li>Live cell assays. Secreted GLuc and SEAP make cell lysis unnecessary. The same sample can be assayed multiple times for different time points, environmental conditions, etc., reducing sample-to-sample variation. Ideal for high-throughput applications.</li>
					<li>Dual-reporter detection. SEAP allows normalization of GLuc signal for greater accuracy.</li>
					<li>Sensitive and robust system. GLuc is 1,000 times more sensitive than firefly and Renilla luciferases.</li>
					<li>Flexible assay conditions. Two robust buffer conditions are provided for GLuc assays: 1) Buffer for greater stability retains more than 90% of signal within the first 10 minutes, extending the half-life of luminescence to 30 minutes; 2) Buffer for higher sensitivity for detecting low GLuc expression.</li>
					<li>Clone and vector compatibility. Compatible with GeneCopoeia’s GLuc-ON™ promoter reporter clones, miTarget™ miRNA target clones, GLuc-ON™ Transcriptional Response Element (TRE) clones, and cloning vectors.</li>
				</ul>
			</p>
			<form action="cart_add.php" method="get" onsubmit="addlink(this);">
				<table class="table_org ">
					<tbody>
						<tr>
							<td style="cursor: pointer;" title="Select All" class="row_single row1">Buy</td>
							<td class="row_single row1" nowrap="">Catalog#</td>
							<td class="row_single row1">Product</td>
							<td class="row_single row1">Description</td>                        <td class="row_single row1">Price</td>	
						</tr>
						<tr>
							<td><input name="cat_nos[]" value="LF032" type="checkbox"></td>
							<td nowrap="">LF032</td>
							<td>Secrete-Pair Dual Luminescence Assay Kit (300 rxns)</td>
							<td>Detects <em>Gaussia</em> luciferase (GLuc) and secreted alkaline phosphatase (SEAP)</td>                		
							<td>$379</td>	
						</tr>
						<tr>
							<td class="row_single"><input name="cat_nos[]" value="LF031" type="checkbox"></td>
							<td class="row_single" nowrap="">LF031</td>
							<td class="row_single">Secrete-Pair Dual Luminescence Assay Kit (100 rxns)</td>
							<td class="row_single">Detects <em>Gaussia</em> luciferase (GLuc) and secreted alkaline phosphatase (SEAP)</td>                		
							<td class="row_single">$139</td>	
						</tr>
						<tr>
							<td><input name="cat_nos[]" value="LF062" type="checkbox"></td>
							<td nowrap="">LF062</td>
							<td>Secrete-Pair <em>Gaussia</em> Luciferase Assay Kit (1000 rxns)</td>
							<td>Detects <em>Gaussia</em> luciferase (GLuc)</td>                	<td>$399</td>	
						</tr>
						<tr>
							<td class="row_single"><input name="cat_nos[]" value="LF061" type="checkbox"></td>
							<td class="row_single" nowrap="">LF061</td>
							<td class="row_single">Secrete-Pair <em>Gaussia</em> Luciferase Assay Kit (100 rxns)</td>
							<td class="row_single">Detects <em>Gaussia</em> luciferase (GLuc)</td><td class="row_single">$77</td>	
						</tr>
						<tr>
							<td><input name="cat_nos[]" value="LF033" type="checkbox"></td>
							<td nowrap="">LF033</td>
							<td>Secrete-Pair Dual Luminescence Assay Kit (1000 rxns)</td>
							<td>Detects <em>Gaussia</em> luciferase (GLuc) and secreted alkaline phosphatase (SEAP)</td>                		
							<td>$959</td>	
						</tr>
					</tbody>
				</table>
				<p><input name="prt" type="hidden" value="1" /></p>
				<table style="width: 100%;" cellspacing="0" cellpadding="0" border="0">
					<tbody>
					<tr>
						<td style="vertical-align: middle;"><input src="/images/add_t_s_c.png" type="image"></td>
						<td style="text-align: right; vertical-align: middle;"><a href="http://gcdev.fulengen.cn/wp-content/uploads/2016/09/Secrete-Pair-™-Luminescence-Assay-Kit-protocol.pdf" target="_blank" rel="noopener"><img class="alignnone size-full wp-image-2495" src="http://gcdev.fulengen.cn/wp-content/uploads/oldimages/product/dual-luminescence-assay/images/userManual.gif" border="0"></a></td>
					</tr>
					</tbody>
				</table>
			</form>
			<!--<div class="cart_display">
				<div class="cart_tip">
					<div class="tip"><strong class="tip_title"></strong><a href="javascript:void(0);" class="btn btn-close">X</a></div>
					<div class="tip_cont">
					</div>
				</div>
			</div>-->
			<div><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cart_tip">打开遮罩层</button></div>
			<div class="modal fade" id="cart_tip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">遮罩层标题</h4>
						</div>
						<div class="modal-body">
							在这里添加一些文本
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal -->
			</div><!--modal-->
            <hr/>
            <div><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginform">打开遮罩层</button></div>
            <div class="modal fade" id="loginform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Please Sign in.</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="" name="form1" action="/login/index.php?url=<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input name="log_email" value="" class="form-control" id="email" size="32" type="text">
                                </div>
                                <div class="checkbox">
                                    <label><input name="log_save" value="1" type="checkbox">Save the information for login automatically</label>
                                </div>
                                <div class="form-group">
                                    <input value="Login" class="btn btn-info" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php?utm_content=login&amp;url=%2Forder%2F"  class="btn btn-default">Register</a>
                                </div>
                                <input name="MM_update" value="form1" type="hidden">
                                <input name="url" value="/order/" type="hidden">
                                <input name="utm_content" value="login" type="hidden">
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal -->
            </div><!--modal-->
            <!-- 测试非cart_add.php-->
            <form action="add_user.php">
                <div class="form-group">
                    <label>Email:</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="pass">pass</label>
                    <input class="form-control" type="password"/>
                </div>
            </form>
		</article>
	</main>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/add_to_cart.js"></script>
</body>
</html>