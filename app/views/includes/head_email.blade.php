	
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
	        font-family: sans-serif;
	    }

	    .page-header{
	    	font-family: sans-serif;
	    }

	</style>

	<!-- Progressive Enhancements -->
    <style>

    	.btn {
		  display: inline-block;
		  padding: 6px 12px;
		  margin-bottom: 0;
		  font-size: 14px;
		  font-weight: normal;
		  line-height: 1.42857143;
		  text-align: center;
		  white-space: nowrap;
		  vertical-align: middle;
		  -ms-touch-action: manipulation;
		      touch-action: manipulation;
		  cursor: pointer;
		  -webkit-user-select: none;
		     -moz-user-select: none;
		      -ms-user-select: none;
		          user-select: none;
		  background-image: none;
		  border: 1px solid transparent;
		  border-radius: 4px;
		}
		.btn:focus,
		.btn:active:focus,
		.btn.active:focus,
		.btn.focus,
		.btn:active.focus,
		.btn.active.focus {
		  outline: 5px auto -webkit-focus-ring-color;
		  outline-offset: -2px;
		}
		.btn:hover,
		.btn:focus,
		.btn.focus {
		  color: #333;
		  text-decoration: none;
		}
		.btn:active,
		.btn.active {
		  background-image: none;
		  outline: 0;
		  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
		          box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
		}
		.btn.disabled,
		.btn[disabled],
		fieldset[disabled] .btn {
		  cursor: not-allowed;
		  filter: alpha(opacity=65);
		  -webkit-box-shadow: none;
		          box-shadow: none;
		  opacity: .65;
		}

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

	    .btn-primary {
		  background-image: -webkit-linear-gradient(top, #337ab7 0%, #265a88 100%);
		  background-image:      -o-linear-gradient(top, #337ab7 0%, #265a88 100%);
		  background-image: -webkit-gradient(linear, left top, left bottom, from(#337ab7), to(#265a88));
		  background-image:         linear-gradient(to bottom, #337ab7 0%, #265a88 100%);
		  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff337ab7', endColorstr='#ff265a88', GradientType=0);
		  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
		  background-repeat: repeat-x;
		  border-color: #245580;
		}

		.btn-danger {
		  background-image: -webkit-linear-gradient(top, #d9534f 0%, #c12e2a 100%);
		  background-image:      -o-linear-gradient(top, #d9534f 0%, #c12e2a 100%);
		  background-image: -webkit-gradient(linear, left top, left bottom, from(#d9534f), to(#c12e2a));
		  background-image:         linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);
		  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd9534f', endColorstr='#ffc12e2a', GradientType=0);
		  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
		  background-repeat: repeat-x;
		  border-color: #b92c28;
		}

		.form-control {
		  display: block;
		  width: 100%;
		  height: 34px;
		  padding: 6px 12px;
		  font-size: 14px;
		  line-height: 1.42857143;
		  color: #555;
		  background-color: #fff;
		  background-image: none;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
		       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		}
		.form-control:focus {
		  border-color: #66afe9;
		  outline: 0;
		  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
		          box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
		}
		.form-control::-moz-placeholder {
		  color: #999;
		  opacity: 1;
		}
		.form-control:-ms-input-placeholder {
		  color: #999;
		}
		.form-control::-webkit-input-placeholder {
		  color: #999;
		}
		.form-control::-ms-expand {
		  background-color: transparent;
		  border: 0;
		}
		.form-control[disabled],
		.form-control[readonly],
		fieldset[disabled] .form-control {
		  background-color: #eee;
		  opacity: 1;
		}
		.form-control[disabled],
		fieldset[disabled] .form-control {
		  cursor: not-allowed;
		}
		textarea.form-control {
		  height: auto;
		}

	    /* Media Queries */
	    @media screen and (max-width: 700px) {

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