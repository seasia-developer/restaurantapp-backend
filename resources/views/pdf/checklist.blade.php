<!DOCTYPE html>
<html>
<head>
    <title>Checklist Details</title>
</head>
<body>
<table width="100%" border="1" style="font-size:10px;padding:2px" name="checklist_pdf">
    <tr style="text-align:center">
        <th><strong>Listing No.</strong></th>
        <th><strong>Type</strong></th>
        <th><strong>Date Due</strong></th>
        <th><strong>Task of Complete</strong></th>
        <th><strong>Due By</strong></th>
        <th><strong>Status</strong></th>
        <th><strong>Latest Note/Email</strong></th>
    </tr>
    <?php foreach($all_deals as $key=>$val) { ?>
    <tr>
        <td>{!! $val->listing_id !!}</td>
        <td>{!! $val->type !!}</td>    
        <td>{!! $val->bclosingdate !!}</td>
        <td>{!! $val->tasks !!}</td>
        <td>{!! $val->agentname !!}</td>
        <td>{!! $val->status !!}</td>
        <td>{!! $val->note_text !!}</td> 
    </tr>
    <?php } ?>
</table>  
</body>
</html>