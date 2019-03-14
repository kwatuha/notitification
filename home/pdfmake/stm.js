

function addHeaders(data) {
	for (var i = 0; i < data[0].length; i++) {
		data[0][i] = { style: 'tableHeader', text: data[0][i] };
	}
	return data;
}
function createPDFStm(data) {
	var reportData = data[0].data;
	reportData = addHeaders(reportData);

	var companyDetails = data[1].company;
	var log;
	getLogo('../pdfmake/images/logo.png', function (logo) {
		log = logo;
	})

	setTimeout(() => {
		var docDefinition = {

			header: function (page, pages) {
				return {
					text: ' Page ' + page + ' of ' + pages,
					alignment: 'right',
					style: 'reportPage'
				};
			},
			footer: function (page, pages) {
				return {
					text: companyDetails[9].section + ' Printed By ' + companyDetails[8].user + ' on ' + companyDetails[7].date,
					alignment: 'center',
					style: 'companysection'
				};
			},
			content: [
				// {
				// 	image: log,
				// 	alignment: 'center'
				// },

				{
					text: companyDetails[0].name,
					alignment: 'center',
					style: 'company'
				},
				{ text: companyDetails[9].section, alignment: 'center', style: 'tableheader' },
				{
					text: companyDetails[1].address + ' '
					+ companyDetails[2].tel + ' '
					+ companyDetails[3].mobile + ' '
					+ companyDetails[4].email + ' '
					+ companyDetails[5].website
					, alignment: 'center', style: 'companysection'
				},
				{
					style: 'tableExample',
					table: {
						headerRows: 1,
						body: reportData
					}
				}
			],

			styles: {
				header: {
					fontSize: 18,
					bold: true,
					color: 'blue',
					margin: [0, 0, 0, 10]
				},
				subheader: {
					fontSize: 16,
					bold: true,
					margin: [0, 10, 0, 5]
				},
				companysection: {
					fontSize: 8,
					bold: true,
					margin: [0, 10, 0, 5]
				},
				company: {
					fontSize: 12,
					bold: true,
					color: 'blue',
					margin: [0, 10, 0, 5]
				},
				tableExample: {
					margin: [0, 5, 0, 15],
					fontSize: 9
				},
				tableHeader: {
					bold: true,
					fontSize: 10,
					color: 'black',
					fillColor: '#CCCCCC'
				},
				reportPage: {
					fontSize: 8,
					margin: [0, 5, 20, 15],
					color: 'black'
				}
			},
			defaultStyle: {
				// alignment: 'justify'
			}
		};

		pdfMake.createPdf(docDefinition).open();
	}, 10);

}
function testOpen() {
	var docDefinition = { content: 'wonderful works' };
	pdfMake.createPdf(docDefinition).open();
}
function testPrint() {
	var docDefinition = { content: 'wonderful works' };
	pdfMake.createPdf(docDefinition).print();
}

function fetchLetterhead() {
	getLogo('images/Logo-large.png', function (base64Img) {
		$scope.letterHead = base64Img;
		$scope.letterHeadIsBusy = false;
	});
}
function getLogo(url, callback) {
	var img = new Image();
	img.crossOrigin = 'Anonymous';
	img.onload = function () {
		var canvas = document.createElement('CANVAS');
		var ctx = canvas.getContext('2d');
		var dataURL;
		canvas.height = this.height;
		canvas.width = this.width;
		ctx.drawImage(this, 0, 0);
		dataURL = canvas.toDataURL();
		callback(dataURL)
		canvas = null;
	};
	img.src = url;

}
