function HTMLtoPDF(){
var pdf = new jsPDF('p', 'pt', 'letter');
source = $('#HTMLtoPDF')[0];
specialElementHandlers = {
	'#bypassme': function(element, renderer){
		return true
	}
}
margins = {
    top: 100,
    left: 50,
    width: 600
  };
  pdf.line(20, 15, 600, 15);
  pdf.text(20,20,'    ');
  pdf.setFontType("italic");
 pdf.text(30,40,'********************************Visit again to- Dr.Care********************************');
 pdf.line(20, 50, 600, 50);
pdf.fromHTML(
  	source // HTML string or DOM elem ref.
  	, margins.left // x coord
  	, margins.top // y coord
  	, {
  		'width': margins.width // max width of content on PDF
  		, 'elementHandlers': specialElementHandlers
  	},
  	function (dispose) {
  	  // dispose: object with X, Y of the last line add to the PDF
  	  //          this allow the insertion of new lines after html
        pdf.save('doctor_kr.pdf');
      }
  )		
}