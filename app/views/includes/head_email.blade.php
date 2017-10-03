	
	<meta charset="utf-8"> <!-- utf-8 works for most cases -->
	<meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
	<title>Bem vindo a Eficaz System {{ $nomeUsuario }} ! </title> <!-- The title tag shows in email notifications, like Android 4.4. -->

	<style type="text/css">

		/* What it does: Remove spaces around the email design added by some email clients. */
		/* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
	    html,
	    body {
		    margin: 0 auto !important;
	        padding: 0 !important;
	        height: 100% !important;
	        width: 100% !important;
	    }

	    /* What it does: Stops email clients resizing small text. */
	    * {
	        -ms-text-size-adjust: 100%;
	        -webkit-text-size-adjust: 100%;
	    }
	        
	    /* What is does: Centers email on Android 4.4 */
	    div[style*="margin: 16px 0"] {
	        margin:0 !important;
	    }


	    /* What it does: Stops Outlook from adding extra spacing to tables. */
	    table,
	    td {
	        mso-table-lspace: 0pt !important;
	        mso-table-rspace: 0pt !important;
	    }

	    /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
	    table {
	        border-spacing: 0 !important;
	        border-collapse: collapse !important;
	        table-layout: fixed !important;
	        margin: 0 auto !important;
	    }
	    table table table {
	            table-layout: auto; 
	    }
	        
	    /* What it does: Uses a better rendering method when resizing images in IE. */
	    img {
	       -ms-interpolation-mode:bicubic;
	    }
	        
	    /* What it does: A work-around for iOS meddling in triggered links. */
	    .mobile-link--footer a,
	    a[x-apple-data-detectors] {
	        color:inherit !important;
	        text-decoration: underline !important;
	    }
	</style>

	<!-- Progressive Enhancements -->
    <style>

    	/* What it does: Hover styles for buttons */
	    .button-td,
	    .button-a {
	        transition: all 100ms ease-in;
	    }
	    .button-td:hover,
	    .button-a:hover {
	        background: #555555 !important;
	        border-color: #555555 !important;
	    }

	    /* Media Queries */
	    @media screen and (max-width: 600px) {

	        .email-container {
	            width: 100% !important;
	            margin: auto !important;
	        }

	        /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
	        .fluid,
	        .fluid-centered {
	            max-width: 100% !important;
	            height: auto !important;
	            margin-left: auto !important;
	            margin-right: auto !important;
	        }
	        /* And center justify these ones. */
	        .fluid-centered {
	            margin-left: auto !important;
	            margin-right: auto !important;
	        }

	        /* What it does: Forces table cells into full-width rows. */
	        .stack-column,
	        .stack-column-center {
	            display: block !important;
	            width: 100% !important;
	            max-width: 100% !important;
	            direction: ltr !important;
	        }
	        /* And center justify these ones. */
	        .stack-column-center {
	            text-align: center !important;
	        }
	        
	        /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
	        .center-on-narrow {
	            text-align: center !important;
	            display: block !important;
	            margin-left: auto !important;
	            margin-right: auto !important;
	            float: none !important;
	        }
	        table.center-on-narrow {
	           	display: inline-block !important;
	        }
	                
	    }
   	</style>