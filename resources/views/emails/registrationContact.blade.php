<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				  <html xmlns="http://www.w3.org/1999/xhtml">
				  <head>
				  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				  <title>Untitled Document</title>
				  <style type="text/css">
					  body {
						  font-family: Arial, Helvetica, sans-serif;
						  font-size: 12px;
						  color:#000;
					  }
				  </style>
				  </head>
				  <body>
				   	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto; width:100% !important;  max-width:700px; color:#000;">
				  	<tr>
						<td style="text-align:left;width:100%" width="100%" colspan="2">
							<img src="https://www.wesellrestaurants.com/public/mailassets/CommonEmailheader.png" style="max-width:100%; width:auto;">
						</td>
					</tr>
					<tr>
					  <td height="50" colspan="2">
					  <span style="font-size:18px; font-weight:bold; color:#c20000;">Contact Us</span> </td>
					</tr>

                    <td>Name</td>
                     <td>{{$contact->name}}</td>

                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>{{$contact->email}}</td>
                    </tr>
                    <tr>
                      <td>Phone Number</td>
                      <td>{{$contact->phone}}</td>
                    </tr>
                    <td>Listing</td>
                    <td>{{$contact->listingId}}
                    </td>
                    </tr>
                    <tr>
                    <td>How can we help you?</td>
                    <td>{{$contact->message}}
                    </td>
                  </tr>
                </tbody>
              </table>


				
				  </body>
				  </html>
