'use strict';
// Class definition

var KTDatatableDataLocalDemo = function() {
	// Private functions

	// demo initializer
	var demo = function() {
		var dataJSONArray = JSON.parse(
			'[{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":95,"OrderID":"95","Country":"Russia","ShipCountry":"RU","ShipCity":"Muchkapskiy","ShipName":"Conn LLC","ShipAddress":"68 5th Drive","CompanyEmail":"fmunford2m@tiny.cc","CompanyAgent":"Francis Munford","CompanyName":"Smith-Stokes","Currency":"RUB","Notes":"tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat","Department":"Beauty","Website":"ox.ac.uk","Latitude":51.8478427,"Longitude":42.4697909,"ShipDate":"9/12/2016","PaymentDate":"2017-01-27 16:06:13","TimeZone":"Europe/Moscow","TotalPayment":"$1001206.62","Status":4,"Type":1,"Actions":null},\n' +
			'{"RecordID":96,"OrderID":"96","Country":"Guam","ShipCountry":"GU","ShipCity":"Agana Heights Village","ShipName":"Mayer-Cole","ShipAddress":"04373 Golden Leaf Center","CompanyEmail":"ckahler2n@histats.com","CompanyAgent":"Catriona Kahler","CompanyName":"Lynch-Satterfield","Currency":"USD","Notes":"ullamcorper purus sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at diam","Department":"Jewelery","Website":"newyorker.com","Latitude":13.4677672,"Longitude":144.7453228,"ShipDate":"7/18/2017","PaymentDate":"2016-06-21 16:10:22","TimeZone":"Pacific/Guam","TotalPayment":"$717532.21","Status":5,"Type":1,"Actions":null},\n' +
			'{"RecordID":97,"OrderID":"97","Country":"Dominica","ShipCountry":"DM","ShipCity":"Soufrière","ShipName":"Ernser, Miller and Barton","ShipAddress":"7 Canary Crossing","CompanyEmail":"gkleinplatz2o@naver.com","CompanyAgent":"Giuseppe Kleinplatz","CompanyName":"Denesik-Wyman","Currency":"XCD","Notes":"congue elementum in hac habitasse platea dictumst morbi vestibulum velit id","Department":"Kids","Website":"miibeian.gov.cn","Latitude":15.2338798,"Longitude":-61.3567483,"ShipDate":"12/20/2017","PaymentDate":"2016-08-13 23:06:00","TimeZone":"America/Dominica","TotalPayment":"$630409.34","Status":2,"Type":3,"Actions":null},\n' +
			'{"RecordID":98,"OrderID":"98","Country":"Mexico","ShipCountry":"MX","ShipCity":"Rancho Nuevo","ShipName":"Borer and Sons","ShipAddress":"424 Birchwood Terrace","CompanyEmail":"lgrinishin2p@hubpages.com","CompanyAgent":"Lucky Grinishin","CompanyName":"O\'Reilly, Block and Goyette","Currency":"MXN","Notes":"mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh","Department":"Tools","Website":"hexun.com","Latitude":22.2222241,"Longitude":-100.9256085,"ShipDate":"12/22/2017","PaymentDate":"2016-04-09 03:07:19","TimeZone":"America/Mexico_City","TotalPayment":"$314052.63","Status":2,"Type":3,"Actions":null},\n' +
			'{"RecordID":99,"OrderID":"99","Country":"Japan","ShipCountry":"JP","ShipCity":"Yokosuka","ShipName":"White, Legros and Carroll","ShipAddress":"8 Annamark Place","CompanyEmail":"mellse2q@xinhuanet.com","CompanyAgent":"Meade Ellse","CompanyName":"Purdy-Carroll","Currency":"JPY","Notes":"magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia","Department":"Sports","Website":"abc.net.au","Latitude":34.6830797,"Longitude":137.9865313,"ShipDate":"12/12/2016","PaymentDate":"2016-08-30 12:27:38","TimeZone":"Asia/Tokyo","TotalPayment":"$1127673.96","Status":1,"Type":1,"Actions":null},\n' +
			'{"RecordID":100,"OrderID":"100","Country":"Honduras","ShipCountry":"HN","ShipCity":"Yuscarán","ShipName":"Anderson, Pfannerstill and Miller","ShipAddress":"116 Bay Way","CompanyEmail":"hensley2r@businessweek.com","CompanyAgent":"Hamil Ensley","CompanyName":"Kessler, Greenfelder and Gaylord","Currency":"HNL","Notes":"nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis","Department":"Kids","Website":"dell.com","Latitude":13.9448964,"Longitude":-86.8508942,"ShipDate":"1/14/2016","PaymentDate":"2016-12-27 22:25:10","TimeZone":"America/Tegucigalpa","TotalPayment":"$386091.31","Status":6,"Type":3,"Actions":null}]');

		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'local',
				source: dataJSONArray,
				pageSize: 0,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				// height: 450, // datatable's body's fixed height
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
			},

			// columns definition
			columns: [
				{
					field: 'RecordID',
					title: '#',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {class: 'kt-checkbox--solid'},
					textAlign: 'center',
				}, {
					field: 'OrderID',
					title: 'No',
				}, {
					field: 'Country',
					title: 'Name',
					template: function(row) {
						return row.Country + ' ' + row.ShipCountry;
					},
				}, {
					field: 'CompanyName',
					title: 'Subscribed Program',
                }, {
					field: 'ShipDate',
					title: 'Last Seen Date',
					type: 'date',
					format: 'MM/DD/YYYY',
				}],
		});

		$('#kt_form_status').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Status');
		});

		$('#kt_form_type').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Type');
		});

		$('#kt_form_status,#kt_form_type').selectpicker();

	};

	return {
		// Public functions
		init: function() {
			// init dmeo
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableDataLocalDemo.init();
});