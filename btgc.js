function toggle(id) {
var e = document.getElementById(id);
if(e.style.display == 'none') {
	e.style.display = 'block';
} else {
	e.style.display = 'none';
}
}

function TR_set_toggle()
{
	var toggleRow = function()
	{
		this.style.display = ((this.style.display == '') ? 'none' : '');
		return false;
	}
 
	for (var oTable, a = 0; a < arguments.length; ++a)
	{
		oTable = document.getElementById(arguments[a]);
     		var r = 0, row, rows = oTable.rows;
     		while (row = rows.item(r++))
			row.toggle = toggleRow;
	}
 
	self.toggleRow = function(row_id)
	{
		document.getElementById(row_id).toggle();
	}
}
 
onload = function()
{
	TR_set_toggle('btgc');
}