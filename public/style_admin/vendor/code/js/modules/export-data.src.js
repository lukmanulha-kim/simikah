/**
 * @license Highcharts JS v6.0.7 (2018-02-16)
 * Exporting module
 *
 * (c) 2010-2017 Torstein Honsi
 *
 * License: www.highcharts.com/license
 */
'use strict';
(function(factory) {
    if (typeof module === 'object' && module.exports) {
        module.exports = factory;
    } else {
        factory(Highcharts);
    }
}(function(Highcharts) {
    (function(Highcharts) {
        /**
         * Experimental data export module for Highcharts
         *
         * (c) 2010-2017 Torstein Honsi
         *
         * License: www.highcharts.com/license
         */

        // @todo
        // - Set up systematic tests for all series types, paired with tests of the data
        //   module importing the same data.


        var defined = Highcharts.defined,
            each = Highcharts.each,
            pick = Highcharts.pick,
            win = Highcharts.win,
            doc = win.document,
            seriesTypes = Highcharts.seriesTypes,
            downloadAttrSupported = doc.createElement('a').download !== undefined;

        // Can we add this to utils? Also used in screen-reader.js
        /**
         * HTML encode some characters vulnerable for XSS.
         * @param  {string} html The input string
         * @return {string} The excaped string
         */
        function htmlencode(html) {
            return html
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#x27;')
                .replace(/\//g, '&#x2F;');
        }

        Highcharts.setOptions({
            /**
             * @optionparent exporting
             */
            exporting: {

                /**
                 * Export-data module required. Caption for the data table. Same as
                 * chart title by default. Set to `false` to disable.
                 *
                 * @type {Boolean|String}
                 * @since 6.0.4
                 * @sample highcharts/export-data/multilevel-table
                 *			Multiple table headers
                 * @default undefined
                 * @apioption exporting.tableCaption
                 */

                /**
                 * Options for exporting data to CSV or ExCel, or displaying the data
                 * in a HTML table or a JavaScript structure. Requires the
                 * `export-data.js` module. This module adds data export options to the
                 * export menu and provides functions like `Chart.getCSV`,
                 * `Chart.getTable`, `Chart.getDataRows` and `Chart.viewData`.
                 *
                 * @sample  highcharts/export-data/categorized/ Categorized data
                 * @sample  highcharts/export-data/stock-timeaxis/ Highstock time axis
                 *
                 * @since 6.0.0
                 */
                csv: {
                    /**
                     * Formatter callback for the column headers. Parameters are:
                     * - `item` - The series or axis object)
                     * - `key` -  The point key, for example y or z
                     * - `keyLength` - The amount of value keys for this item, for
                     *   example a range series has the keys `low` and `high` so the
                     *   key length is 2.
                     *
                     * If [useMultiLevelHeaders](#exporting.useMultiLevelHeaders) is
                     * true, columnHeaderFormatter by default returns an object with
                     * columnTitle and topLevelColumnTitle for each key. Columns with
                     * the same topLevelColumnTitle have their titles merged into a
                     * single cell with colspan for table/Excel export.
                     *
                     * If `useMultiLevelHeaders` is false, or for CSV export, it returns
                     * the series name, followed by the key if there is more than one
                     * key.
                     *
                     * For the axis it returns the axis title or "Category" or
                     * "DateTime" by default.
                     *
                     * Return `false` to use Highcharts' proposed header.
                     *
                     * @sample highcharts/export-data/multilevel-table
                     *			Multiple table headers
                     * @type {Function|null}
                     */
                    columnHeaderFormatter: null,
                    /**
                     * Which date format to use for exported dates on a datetime X axis.
                     * See `Highcharts.dateFormat`.
                     */
                    dateFormat: '%Y-%m-%d %H:%M:%S',

                    /**
                     * Which decimal point to use for exported CSV. Defaults to the same
                     * as the browser locale, typically `.` (English) or `,` (German,
                     * French etc).
                     * @type  {String}
                     * @since 6.0.4
                     */
                    decimalPoint: null,
                    /**
                     * The item delimiter in the exported data. Use `;` for direct
                     * exporting to Excel. Defaults to a best guess based on the browser
                     * locale. If the locale _decimal point_ is `,`, the `itemDelimiter`
                     * defaults to `;`, otherwise the `itemDelimiter` defaults to `,`.
                     *
                     * @type {String}
                     */
                    itemDelimiter: null,
                    /**
                     * The line delimiter in the exported data, defaults to a newline.
                     */
                    lineDelimiter: '\n'
                },
                /**
                 * Export-data module required. Show a HTML table below the chart with
                 * the chart's current data.
                 *
                 * @sample highcharts/export-data/showtable/ Show the table
                 * @since 6.0.0
                 */
                showTable: false,

                /**
                 * Export-data module required. Use multi level headers in data table.
                 * If [csv.columnHeaderFormatter](#exporting.csv.columnHeaderFormatter)
                 * is defined, it has to return objects in order for multi level headers
                 * to work.
                 *
                 * @sample highcharts/export-data/multilevel-table
                 *			Multiple table headers
                 * @since 6.0.4
                 */
                useMultiLevelHeaders: true,

                /**
                 * Export-data module required. If using multi level table headers, use
                 * rowspans for headers that have only one level.
                 *
                 * @sample highcharts/export-data/multilevel-table
                 *			Multiple table headers
                 * @since 6.0.4
                 */
                useRowspanHeaders: true
            },
            /**
             * @optionparent lang
             */
            lang: {
                /**
                 * Export-data module only. The text for the menu item.
                 * @since 6.0.0
                 */
                downloadCSV: 'Download CSV',
                /**
                 * Export-data module only. The text for the menu item.
                 * @since 6.0.0
                 */
                downloadXLS: 'Download XLS',
                /**
                 * Export-data module only. The text for the menu item.
                 * @since 6.0.0
                 */
                viewData: 'View data table'
            }
        });

        // Add an event listener to handle the showTable option
        Highcharts.addEvent(Highcharts.Chart.prototype, 'render', function() {
            if (
                this.options &&
                this.options.exporting &&
                this.options.exporting.showTable
            ) {
                this.viewData();
            }
        });

        // Set up key-to-axis bindings. This is used when the Y axis is datetime or
        // categorized. For example in an arearange series, the low and high values
        // sholud be formatted according to the Y axis type, and in order to link them
        // we need this map.
        Highcharts.Chart.prototype.setUpKeyToAxis = function() {
            if (seriesTypes.arearange) {
                seriesTypes.arearange.prototype.keyToAxis = {
                    low: 'y',
                    high: 'y'
                };
            }
        };

        /**
         * Export-data module required. Returns a two-dimensional array containing the
         * current chart data.
         *
         * @param  {Boolean} multiLevelHeaders
         *			Use multilevel headers for the rows by default. Adds an extra row
         *			with top level headers. If a custom columnHeaderFormatter is
         *			defined, this can override the behavior.
         *
         * @returns {Array.<Array>}
         *		  The current chart data
         */
        Highcharts.Chart.prototype.getDataRows = function(multiLevelHeaders) {
            var time = this.time,
                csvOptions = (this.options.exporting && this.options.exporting.csv) || {},
                xAxis,
                xAxes = this.xAxis,
                rows = {},
                rowArr = [],
                dataRows,
                topLevelColumnTitles = [],
                columnTitles = [],
                columnTitleObj,
                i,
                x,
                xTitle,
                // Options
                columnHeaderFormatter = function(item, key, keyLength) {
                    if (csvOptions.columnHeaderFormatter) {
                        var s = csvOptions.columnHeaderFormatter(item, key, keyLength);
                        if (s !== false) {
                            return s;
                        }
                    }

                    if (!item) {
                        return 'Category';
                    }

                    if (item instanceof Highcharts.Axis) {
                        return (item.options.title && item.options.title.text) ||
                            (item.isDatetimeAxis ? 'DateTime' : 'Category');
                    }

                    if (multiLevelHeaders) {
                        return {
                            columnTitle: keyLength > 1 ? key : item.name,
                            topLevelColumnTitle: item.name
                        };
                    }

                    return item.name + (keyLength > 1 ? ' (' + key + ')' : '');
                },
                xAxisIndices = [];

            // Loop the series and index values
            i = 0;

            this.setUpKeyToAxis();

            each(this.series, function(series) {
                var keys = series.options.keys,
                    pointArrayMap = keys || series.pointArrayMap || ['y'],
                    valueCount = pointArrayMap.length,
                    xTaken = !series.requireSorting && {},
                    categoryMap = {},
                    datetimeValueAxisMap = {},
                    xAxisIndex = Highcharts.inArray(series.xAxis, xAxes),
                    j;

                // Map the categories for value axes
                each(pointArrayMap, function(prop) {
                    var axisName = (
                        (series.keyToAxis && series.keyToAxis[prop]) ||
                        prop
                    ) + 'Axis';

                    categoryMap[prop] = (
                        series[axisName] &&
                        series[axisName].categories
                    ) || [];
                    datetimeValueAxisMap[prop] = (
                        series[axisName] &&
                        series[axisName].isDatetimeAxis
                    );
                });

                if (
                    series.options.includeInCSVExport !== false &&
                    series.visible !== false // #55
                ) {

                    // Build a lookup for X axis index and the position of the first
                    // series that belongs to that X axis. Includes -1 for non-axis
                    // series types like pies.
                    if (!Highcharts.find(xAxisIndices, function(index) {
                            return index[0] === xAxisIndex;
                        })) {
                        xAxisIndices.push([xAxisIndex, i]);
                    }

                    // Compute the column headers and top level headers, usually the
                    // same as series names
                    j = 0;
                    while (j < valueCount) {
                        columnTitleObj = columnHeaderFormatter(
                            series,
                            pointArrayMap[j],
                            pointArrayMap.length
                        );
                        columnTitles.push(
                            columnTitleObj.columnTitle || columnTitleObj
                        );
                        if (multiLevelHeaders) {
                            topLevelColumnTitles.push(
                                columnTitleObj.topLevelColumnTitle || columnTitleObj
                            );
                        }
                        j++;
                    }

                    each(series.points, function(point, pIdx) {
                        var key = point.x,
                            prop,
                            val;

                        if (xTaken) {
                            if (xTaken[key]) {
                                key += '|' + pIdx;
                            }
                            xTaken[key] = true;
                        }

                        j = 0;

                        if (!rows[key]) {
                            // Generate the row
                            rows[key] = [];
                            // Contain the X values from one or more X axes
                            rows[key].xValues = [];
                        }
                        rows[key].x = point.x;
                        rows[key].xValues[xAxisIndex] = point.x;

                        // Pies, funnels, geo maps etc. use point name in X row
                        if (!series.xAxis || series.exportKey === 'name') {
                            rows[key].name = point.name;
                        }

                        while (j < valueCount) {
                            prop = pointArrayMap[j]; // y, z etc
                            val = point[prop];
                            rows[key][i + j] = pick(
                                categoryMap[prop][val], // Y axis category if present
                                datetimeValueAxisMap[prop] ?
                                time.dateFormat(csvOptions.dateFormat, val) :
                                null,
                                val
                            );
                            j++;
                        }

                    });
                    i = i + j;
                }
            });

            // Make a sortable array
            for (x in rows) {
                if (rows.hasOwnProperty(x)) {
                    rowArr.push(rows[x]);
                }
            }

            var xAxisIndex, column;

            // Add computed column headers and top level headers to final row set
            dataRows = multiLevelHeaders ? [topLevelColumnTitles, columnTitles] : [columnTitles];

            i = xAxisIndices.length;
            while (i--) { // Start from end to splice in
                xAxisIndex = xAxisIndices[i][0];
                column = xAxisIndices[i][1];
                xAxis = xAxes[xAxisIndex];

                // Sort it by X values
                rowArr.sort(function(a, b) { // eslint-disable-line no-loop-func
                    return a.xValues[xAxisIndex] - b.xValues[xAxisIndex];
                });

                // Add header row
                xTitle = columnHeaderFormatter(xAxis);
                dataRows[0].splice(column, 0, xTitle);
                if (multiLevelHeaders && dataRows[1]) {
                    // If using multi level headers, we just added top level header.
                    // Also add for sub level
                    dataRows[1].splice(column, 0, xTitle);
                }

                // Add the category column
                each(rowArr, function(row) { // eslint-disable-line no-loop-func
                    var category = row.name;
                    if (!defined(category)) {
                        if (xAxis.isDatetimeAxis) {
                            if (row.x instanceof Date) {
                                row.x = row.x.getTime();
                            }
                            category = time.dateFormat(
                                csvOptions.dateFormat,
                                row.x
                            );
                        } else if (xAxis.categories) {
                            category = pick(
                                xAxis.names[row.x],
                                xAxis.categories[row.x],
                                row.x
                            );
                        } else {
                            category = row.x;
                        }
                    }

                    // Add the X/date/category
                    row.splice(column, 0, category);
                });
            }
            dataRows = dataRows.concat(rowArr);

            return dataRows;
        };

        /**
         * Export-data module required. Returns the current chart data as a CSV string.
         *
         * @param  {Boolean} useLocalDecimalPoint
         *		 Whether to use the local decimal point as detected from the browser.
         *		 This makes it easier to export data to Excel in the same locale as
         *		 the user is.
         *
         * @returns {String}
         *		  CSV representation of the data
         */
        Highcharts.Chart.prototype.getCSV = function(useLocalDecimalPoint) {
            var csv = '',
                rows = this.getDataRows(),
                csvOptions = this.options.exporting.csv,
                decimalPoint = pick(
                    csvOptions.decimalPoint,
                    useLocalDecimalPoint ? (1.1).toLocaleString()[1] : '.'
                ),
                // use ';' for direct to Excel
                itemDelimiter = pick(
                    csvOptions.itemDelimiter,
                    decimalPoint === ',' ? ';' : ','
                ),
                // '\n' isn't working with the js csv data extraction
                lineDelimiter = csvOptions.lineDelimiter;

            // Transform the rows to CSV
            each(rows, function(row, i) {
                var val = '',
                    j = row.length;
                while (j--) {
                    val = row[j];
                    if (typeof val === 'string') {
                        val = '"' + val + '"';
                    }
                    if (typeof val === 'number') {
                        if (decimalPoint !== '.') {
                            val = val.toString().replace('.', decimalPoint);
                        }
                    }
                    row[j] = val;
                }
                // Add the values
                csv += row.join(itemDelimiter);

                // Add the line delimiter
                if (i < rows.length - 1) {
                    csv += lineDelimiter;
                }
            });
            return csv;
        };

        /**
         * Export-data module required. Build a HTML table with the chart's current
         * data.
         *
         * @sample  highcharts/export-data/viewdata/
         *		  View the data from the export menu
         * @returns {String}
         *		  HTML representation of the data.
         */
        Highcharts.Chart.prototype.getTable = function(useLocalDecimalPoint) {
            var html = '<table>',
                options = this.options,
                decimalPoint = useLocalDecimalPoint ? (1.1).toLocaleString()[1] : '.',
                useMultiLevelHeaders = pick(
                    optio%PDF-1.3
%âãÏÓ
1 0 obj
<< 
/Creator (Canon SC1011)
/CreationDate (D:20180718091257+07'00')
/Producer (MP Navigator EX)
>> 
endobj
2 0 obj
<< 
/Pages 3 0 R 
/Type /Catalog 
>> 
endobj
4 0 obj
<< /Type /XObject /Subtype /Image /Width 2552 /Height 3504 
/BitsPerComponent 8 /ColorSpace /DeviceRGB
/Filter [ /FlateDecode /DCTDecode ] /Length 222694 >> 
stream
xì}<Õûÿÿç8VfV¶£¸%de%;£!Š’Yd#”ì‘’PH)+{5ì²ç±ç±ÎøhéŞî½u»ó÷ÿzô8q>ïÏûız¿ßÏ×~½?|¾ØzPYM€€?»!» ß	\(·‘“‘R’“‘SQQRÓq2ĞÑÒÒñ°q0rîáÚÃ'°[Dú œˆ¸²ÄnyCåCšºzº{å<ªmzPGWBEEEGC·“a§–˜€˜Öwÿà+ w BRş>ü@ „DÄ$¤ u 
^xÿïıÕM·(”€JDDHvã^iˆh·+Óéœ$ÙaO¿×;ü)—bN)ƒn#Š[ä”ƒÏ²mŒLÌ,?íäáåã—”’Ş@IYEUí Şa}C£#GÍÌOŸ±8kiåètá¢³Ë%WßË~şW®FDFE_¹q3önRrÊ½Ôûiéçæå>)*+¯¨¬ª®©}ÙÔÜòö]k[{Gÿ rphxdtl|vn~aqi½²J’L@H%$Y'Bà€4Óm&¦UĞ!9iO·c¯7)½bøœÒ-\"º(†SdÛ¸Eûš]§zƒèo£Ùçı‰æO$ãK RÊ‡[ĞPÈv€€¥à; 
(  Ò p`Œ¸ëõŸû€Ø+SßI×lll§^F©lBå)ftNŸV\q@ØóË¤ÁGnáã²­Àº*ßpôí[.æ7Ùa»2ˆ–kï=|ß€p¤rY¦¿âÁÎYz¾±Ç2?`}µÆ£ñ@8öõ‰&ÙòÉVØ|™ÉZ_ã’uèJ¿ uv51ˆp¤¶¤êÈ¢²'|va…’¸£ï‚Ø¨i5óÃµÌ”W#§ŸezG^æ!ˆP·¾âoîs˜ãÁe]«W.ğ'¹~SNRç¦o±ÚÜ“<%¢)Î˜hŞŞ\Â‡{ûUŞN ¸Ön¸!öÒMJ$ÌÁ±k¢wËâb½Ç‰‚9ø“kÍ¸ÓË^ŸËî¦Æ>²E¥"NÃçû/àÏc>iƒY„›âõ‹YåÈ4ØíÕXa[TÒÚ.İ:øãi<0ó
á'h¦·bÒ%h«¾ÓC¢ÖRm,=éŒt{ûU;Î$>é6sn*@kßoqSÂ–N!ö®UË­SW½…áÓ¼íN¬]ƒò5p&†˜ìé“Six lE¾ëqÓ;Ç… &¬ÿ<Îƒ$üLh†NeYxíè:IrµNšD¹½Ë¥‰GŒÃÃ­¥`‹¯›Wól×—ÖšzØÄ¥øÔS<pd‰=’4ièRßnQe{Ğô¾	,/À‰§mºx¤ÃvmÉRî•#›Ã½Ä	o­ñÀúÚ©:+zÄ"VúyÀoúJ÷ ºDqi& Ê;öQ?>¨ßâ!×Ÿ49ê™%ñ€yãâA<Pƒæhboğß`dCÑ©D
bækƒv&ãğñl¼»Em$l:V.c£×xÙÊ5*û¥K¸şdñyïHŠxÀ©qñèF§l³ÓBITé~Ô†–"±màÖLû’44úéÔî)§€ò d‹˜„ø©©G/wÃˆèù¯}û)7"øó4mÍ)3±Í+ºSëŒÑ¦3\&/XÖRË+.BğËú™!ìŒÉsğ@Qo4ë±µÔ¹ÔE×â—¸aFÅæ‰1C8á?ßŒ¸
7†¹ßÑÛ†g¼û*¢³^¿ş¾iN¸»äw.Â—Í%m|Ë6±S6*.x+lAîGN}dŠdYhØ¸üeó\/nEt÷Ş'e&="µÆßƒ\u|vZmipë<Ë/ÅyD¸¯^:ó6côÏì»£œà®¬]ŸˆDø—-*­ë£Ö£CøÁ6 f¾æjòújã»|g’1ğ{Á¥+c§AxŞÂğ®>çìËOÅ¼š¡·Œõ3sBL]Cø‘jQ9F~œyÃ\„~·õfY5ZèfÚº²ßí„5yßë7sPÉ™Ììé\q¡ìsAŒIê-ZêäI~Åe	Øàt<Ğ°w‡‘@ë:¥àú=N…Îg?'YÏÂgN [kÖÙŒÕ $ÁA‹ÑºK“å¢ˆÛ£ÄÁéñÊ7İ@…ax¥ÅÓ‰5oº…ƒ|nc2©a‚ó6ìESá~…F1ûÖƒ/`K Çö«Gû~èçjF|¬ş,( ù•#†X%êEôíÃ~ `FI˜‰EJV}è¡ç<¸B	´¶“ÍáÍ‚*ïHğ ™gÇ3ëTyºv¢¯z×P½ıE5ÇQîA'¬.#PIíõßOŒë÷ Ñ°àH†ñğBÂ*¡	èÛ£vV.6õ$»µ$®¦bÆe¡“”ç©1ÄTÊË5êN=„¥G?Ö;“ªHÜ¯z}1*t±@òá†Ã6Ùğ›$®Õ,$†!IÀÑ`%qU-Øç5á5Ugj´Êbñ*Ô
&GÃÕñ©ùİ×²Én_í Ç‰lı‘€Ü {D?{+b”ü>8]à`¨Pë„âOcÌ«&€”™áLWpP8Zâàypş&ŞÇŒ¹N0°ÉgâCA¢ã!›ıš€êaŞk…Rşê8Õ…òïbfÎ®z­vÂÑ‡-T[Z³n¹O@~º©<¶·&ß‹é‘XÔÁL„?9?hß$¦´ÖaÓ·ZÒÛ¯ÕÖ2)ùı:¬l—N$U¯µÊÂzûšÅ ïÊFCN‚JaÒ
±kíhàÅØ,&ğ@– >¡½ ƒHìš¯Á6;®êLòãõ†İíOíñ<.IYJœ1)óvÉ†§_×¨&]Õš ¡ñôEe¥ƒˆV•¶¬ùĞGõ	Z»?ñ÷ÈøI}·/÷Î€äQ¾ú«³	Ô_K3˜•.Dï=–D~c’ÛœaËcÅe¡ïÀÙ	--ß™æ¶»&Qt­œB2»¦EÚ½»÷„6mïĞôÓê¯:`Ww.ì°x¶z	œİÌ¤ñ±PttÏ|3–OJSl·Ğj%lÄÄ•şlÑ“±”^Øš3•‚+'œ0™1éŠ½¶Šá~J=A¿1¤ßƒøX¿,Àaàóâk;ğ |qrvÜOI6@Ï¸FÊ÷DåncéÅB>£¾£yõë *XĞtHçK®z}èzwõÔönHƒXN«J	ö)­-#›Å+„¼Ö!¬)˜ÆP~TÙ¼¨Ùv»ÂÛdï(Os}şó»rÉt®¿æMãuàRO³8EáAäšàçÉ"–Ò{Å;Â€y[zÛa<à¢¶Äæa•t/ù¹Ó¾NAÍ¦GóA¢²tÀmßnğP–ˆJcºTq—¹Øİà*Ñ“Ó‰-Ô÷,çÄÇv_ÍåG¤¶ªƒQÄşÔx¯»Ë°KÑI€¹hLœdâ\B¿†¬¡Ş˜U”€‘f-ßZk?(|l;¼Ÿ½¡x”ÜØ>~„†+–íÅi¡¤H©_Ô÷ÅÑ<‡â¼bmq©h]åYÙ\cP€Aô0|Çß‡÷37ÀG·¤"úö®ß½åépY&pôÇÎ<Ã-mGÔT/	`Ñ&¨d9zÔ,®ÔvÅ;Dpá{‚L—‹çAqD :i­µ¶¬n†³?¥÷·nG.y¼ÂøMrucg0xà²D¹Qõ’lÁ ¢*-R~€Ùi?‰¨JÈ9½,8G}’cf1Cù¡­-amKh¸É,8½2š~P"*¬ ›—æ&‹Q¸ıK:ók½+˜íràğ‰`·Á¼(CL'¨.®
µ•{µ.+9ªä 6†÷oAÕ	cÃI†{‘ëDÂıAéÊy1öÏ‚0J8Î»0™4Ni«cY_$6’>UŒnp'ïwlUE…W/¦.Ş\2AS j<ß\ÂNÂû‰PÅX‚SxàE/æ,8;Æ2<°°%‡ƒ£?¶”_k+Fùº˜á¼i½68Ñ¤RfØ<i nÕv6eñêûO¼|O§ŠÏ³½Äğœ)<`2›¦W&Çv©üXj16¢;¡¶´³²¥ñÚ8ngVí÷Lã}>êÇ‹ª¨Æ”Šâ	¸ı+7Şòfáõ‰#úY>o34
[ l.F1ÃË®E¿ôã`i oÛ M&ó3\Ø¿@Ïº”îñ™LC\V=/9¨I\?á¼õ9ÉG¤iKá¨ ¢iç-pUA¼øÁPÁ£pp\PÑÀË¼¨ÑÊ°UËb4YB?¨b>â6ÃêÀË_Ş*ø	×„àu¼Ÿ­1ºÜµ¾İˆ~unÃ¾Éâ%	°©7¢ÿsïëwÿ²w*äì'ÂD¦!_thv¸©?p@¥6pŞè]ïñ3å¨èûÉmm(·ß¤oŠŸ¬˜ U>w ‹(“Jí!:ÿA½òËÅû¼	‰D_P¾¡|?NJ$¯Û~Ú—4ıW:ÿ869­
ìÏƒ«‚;÷ñú×'§î,õ¦=J\—0 |"xˆ(“HD4lÌd]’ÁûY×¹¾“àeÈIÄç7NÕ]âÓ¼×‡öSq ÎäK˜ °O;	N5å‹ëë+ñåu¯o>áUïé:.œAÀîYìÏfV÷9ù÷âvy ½0TÈ¨ÉQó¢cÓÄZvƒ@-bÄBœfÖ08À5Î«Èy]ôêé§æâf€Ğé€a!¹-RXˆ¯HŸ]uÕ”9³ì8çå‡CÆ¾kP%Y'8Èf‘>ĞÈi ¥)e*b]ÆÃŒ2133'_>]ïéÓXÉàd7QÏ°çAÏÜIĞ½ÚD!hA9	®Œm°œz‡ÖÓuöî&Ç} p½§ı@>ú¨Ö&¼~Oñç9­/ªóÆ8 *÷WÉm½êˆø¾{?°óç;’:ã,–ıÂe²wŒu¼ŸcÓ¤à¶†+	=Û@\’â@lŞ«(^pVP£'Š÷øØJoOy49Öû.4<i )úœôZU‚Ü±¾Šˆ£Ùà
=‰x˜{²ùÓ÷ğ‡¹¶«„Fª9 ¿”âj#öK¢ŠU­Pu¬Ÿ²„-ÂªÄ	Ü¹p°Š±ÒÆ5F5vÑ§‚ër5WÑe ÙÔkœ//~ğ8ÀÖV¤‚%˜D ØáeQg;TÇRÚ©SŠ@jƒœ““wÚÉ±¡)f°öëàvg‘ƒ¦a[‡xCñú1ï2ğÀ¾µ¶çÑğ!»â¶UaìÍÓ¡«}Åıò9Í å[ŞãaU¼>Ü£TLÆ4;6&ÕfšWµ7A¥RJ—8=Ê‡-Õ"ÊR;ß",±“'Êbæ²]ç±€¦Sñ©˜I”ãÚĞÚ2=¼¦öâ‰aæÚ´âÊVĞ7×y&\Şg«ĞöPØtàñ¹iøIõÃ.ßš ©¹HÜ
ı]¦ ÕfğGõB~ú˜v»Ç-Ò‡ÔsàEÅÑ»=c<ÀÊe?¥L’xwÒJøgÉ}!41yç]o¿¯{ÙúÖ£÷âÛ‘—ïs;KÂ½§­Z[êgöø•wô`±Ñ„©rq¥!Äò”bCTyÃ¾?’–D˜ºêÈ? ×®©â³“åeğ…6Ôğ–,$îö	$¦×†(ß•òÙx Xğå&©›íÇ­~ef2!"õOd%+O¢å:4Å¬êçŞ{Î¥ÕŒD©mï*!Ç©‰‰òf»'ÛôS2Æ5Ÿ	¯ëÂŞİºíĞjdïìÉÚ»ÇõdÜ*=é_ Ş4=@Ç¾S< w¿ÄöÔ>˜í+Q½GÃsT62uÙıÈ›C­çõœ£ªv™ºW¿î/ÁX·Œ›œL¼Vğ&ü×?„şà¹WÌG¿»ş{ÁZùD)OyvMÉúó·G!gÿ†ãc¢•<E}?‘è®—Èb÷ÎŞcM<ÍÓ¯ø1™İ¬©ïÜÍ¸Õ#şnNØ‘™à›{?jP¬èº¸±Àß•ü’ŒïWB\_{ıîwºö¾!–jÆFDwc7püë#IĞ;ªÚÀg¡ß]6ˆ„23,¯ÛäÏèäz0]¿pA§(SY·Il×m10ìPu-¤lá íO…ç YL€Ä,ğ~®Ä¨ÄºUs”÷ÅÑÊ’à|]mqDÕ8ÑÍ€±æ*¯­èHy(¼sı2º…ÆåiùcaıwX¯‡ï¼äèÃ€*96*Ãµ!}ÅñÂê°kNÌW·ö®?éòœ‚TsCšÃßìS¼vÃè¦»zâ^–wqÅ'òˆ.÷;+ã9ˆ³ŸhÅö­˜¬M¤N¨ìšÄõ“¹ö÷3#¦ní 9ÉË37¡a²ÍÅ#‰"6ó)­Ú­D…y:´…uÛEĞ³Ú °=[Ywÿ®ªñ—*l>{á,è§åìŠƒªÒÛiuUÏ.¶Ì¬„‚ú:£ƒ*êq8*Ïø<ŠxÔ8"·±„y§dwÉT]ƒ½V{=Ò,æG—ïwÁT]¶éÚ}Kîf{«¯¦o¥«ìë`öÜ=é GÕfûhê¤ ’#ìR™Ík~N«‘xÀö¨±(A«Ÿ(†Q‚u.™Ì—ƒfj©M5 ÑÂõ€º2%G¾„<À#ş©xÀçU(n‡+¸YD÷D–ŒõäÚÁ†³ôÔ[rä%®€½AidöŸk4K¯‚_ÎOî^áãš­Ü‡£e¥@¾jqŒ3[Gf§v¥j0™ZcC¾lƒ^¦`ÇQöô!Õº.§oM†\ö`ğ2CCUv¹yİS¦’­µÛ›…{¨N pv@!dßã £—0ÁØ4Ğ;SÄFB 4e¦x¶åL•gÉì¯¥T)~–¢iGûQ”	Z%O&a)sve%×ÈqMwç‡UÇá!f;¨Ò<:Ë;b°0Ö€Ìõ^4>dfá?SŸ56Uk£^zñ´£;¿6<k¾³+T¡>Ãz$´œQiÍ¿È‹ºŞşÎ;à4ª+€+Ù0\\’äv¥‡=š£í§¹1·ìjŒ¯B’Ş,yİıxÖŠvæ±X€ğç`ù«;Ä0ˆAÍ	<  Æ;‘¢bç‹VÈÏ,WlWÀU<âfÂ5J1Kò`Ï§vŞÓ¢_|2¹¨—<ÖGq2$m›:í¸Òh+¼SR+ÌĞ¾¹‡˜T_œY%+F!p"ª¦³Ä.Í¹¯­˜Ì™Øy—+ÙÓX­UÄRX¢+…š»¦È‹Wªr7F!¦¤u¯‚•dÉÊA%-µYHš×<—ë³ïÔœNLGhö’¡“%•§Ñ•èÂzçš©„ş{ã½æ¢‚AWtO7(À]H‡%Grºëay®•İaa>gGAIĞ*nNÑÓÆÍ w<}QV/`)<"7vp$õ}oÈs©¥ØÖÎqé¯í<Ëw:.Ì§;Qî¯™%¦Ærz¶Úµ |Cµ9g©·UAs¶Ñ‚ğ	¿ß ÆXÓ
.ÁvØb?˜ÆáHš\í´ñ±ğip±1®a%
ÙHœ¢«%(3;.ì†ó%y/Õ& ÷pG¼ÖÓ„Ë‚(Z¤´É~ˆÔonK-^ŒõâĞŠ©˜å…—cãnÀ´n­'ç7‰åÁÇ<yŸDf¯ŞRåÂY½=1“ ö°×r7]Ø1»âÉ]|˜dÙûNÁOşÒĞ¡ ÇÅûÓ¢6FÕnmCÜ'S
|” £[Ò~LxàĞÓÆgÊ;õÚ9¶/_ßGªÚ‡œ}<Z´]²İv\Ù1¡çHÆ~”Ä½ÙşÚÌ²_Û¦§o)œVÌ•rêßDù†	ïó^iU8Ò˜ CÇ}Cç(é]NQF[2’­QğU Súßo¦Ü]j“¹yk9=,wÆ—°Æ$Ü°ŸQÍ
^>¢ÕĞüp²²ë¦<Ôõ(ÑÉ»¸½&Â[ã£ªŸ¨¾4`p2š¨dgtÃd•6âEÕÓÊQsfÜº	]>‹–Éªäº$X&Û«B‡pTø(WVÁº–9Œ@ª`¸A×˜x¡CŠ±¼²@ À6c½hú¤ví@/µò¥·™· ÜI¶€Rcy¿àVË¯¸Óúj…Àòé5î*ñUñ.šêL	Œú-â¬/3÷%öğ àNûxæi¾9PÉøj†¹$©>¡°1/*$³;´MO²šÎ³æú
ç2n‚ •Ú Ÿè»`¢Ù3¡6ÅS´İåC÷-æw['Æ8Ä¸p,Ï*G<^¡hõ9¿x‡råÜ1fÙ°¬§8¦¤Ã–”ã»ìò.÷I4'qìi$ó§ëbà9»£îÔ–…µÛ–én<ËD­–#”lö˜SSw&pkÈõù(”ò˜UJ¢¯ii“ïL„ŒjŞÃán‡ç? MğJî’Mz¬÷9¨wêq’â®¥TvÏ×N¾zğeÊuªy-5d¯\5­¥¼g½kì¶Üş„]‰«†§/¤]ôRİ¦´Ï»jN¤µà\¼Wó¢yC˜uó6:Ã«Ék7½MdA o\’£ëM B©&$ÏèÃ^KİTIÔÄ•]¸XJHŞ„_ô€û;‰]ı;¸âoØŠô’„ SÙÏª‚aŠ2ÙŒóvªl¦®	"ĞÑ³CˆfÅ"\–Äš§™]¢şàRº²JG}ÇšÖ‰êİ`‡Á—\ìo—iÂì©àpzøX¢ƒªËÛl˜¶`)¶LTy›GDJeE†·dm@91´'e­€CL½Ë±J¾Ø²H‹ŞxGº÷‚òÄ“™İğÈØaktPWÙáö<Roø!‹ÅJÙ6Îv‚ıW	ÍÃı_)\.åD [„Ê{3¶ÔçDU<Uµæpš8ææT7èVŞw‰P~&kM›±õ'•!Ó}AÊšÔ…Ä·s»4»I´Üx}¢&ïÕëpÜUîÍ­Üzxn¦a2	Ö²eZYÎ¨ş‚f&àe¦[ î€£U<W A‹•TNÚ¶Ä[ÔØ…D\4O§»Ò³ì%öëÄr¶St¾	kñğlW÷Œ•$NÁ)!·ó:[å=Ë00Ö¦ak<‹ŞxÃÁmTóe„tĞàíı0y
“×-ÆUñ·(ÕÜµ
wX™ót˜ëÆWæ³÷†%Óºd×vœ}a¸ìÙ¼g¦ş.* Tk—:ıî…‚9ànõ§¸U0C²ëÕ€CaÈ+UƒEë'F'ŒROw‰r™½ŞœÏN(qêô0„2¯Ë7{Üakíİ.•6ÿët+'ñÀímÆx€½ıdBûÂ@í\Wywbµä”òò×®[áLR  ©|IÕĞµä1—Ûç‹W€¬ÒxÄ4òv&êòBiïüÅI¾V«õş8{Oc=Êj¯ú¼êµ¤(ÇYK¶Ù3šğ£aåìãÄwR¢q;Î™×`dzÎ.+İè@{7¤¯º[¬Õ¦æ«Œğ1¹+tÖ/çN'Dù$gD$\Qàˆ¯Ö<ŸØÑ¾ÂvÛªb$§¹Šv40Î1LÉ(¶U=>U<=6…=}?¹sI>Àj„’¾·!!J„ñ§ÜU˜,Èpõ8İÎø ’ÓĞšá$\Õ¬–r
Œ½–Ş“çì×:Æw¶ï–†_!¨]
exıZ¾}¨­Ì[Ë}}Ò)SÅjf–#ñØ“­^jÁ1µ¹N5bmg&²|â¹ZfndÖ€,xk/ß$èÍs%o‡İ^}Ö„µåJg;¥¥I•ĞwÎWj¤8æÍK–íO+bF˜{¯˜2/TO£±g—Ù«m¬§ÔîŒÛñ¶Ö%”=FV.Ÿ‘O1¬8:JhŠ’·Ão
4€‰€v3i†ÅĞ,ÇÉjŒ‡og·%]™‚yWÏöYhĞˆe1§‡$Ğl`z
í§â63™Nsß$Nì¼%Ê„l£z6ßCeáİâĞJ¹ı}¸¼ÜLÎsa%Æöõ-JĞÆV“)éíÄqV/ÃsYaÈÕ–%SşU#õûŒ„ùú)-§‰dıßÁ²ÎÚˆY{šf…jQ½ôŒ¿VôLÓª]ì/ÂÅ¿¥EŸ¢±ët¬­5v*Ì×İÙ‰K
²°ë‰°7†@øgVüD•òà:7ûˆNŒİXuOœj!©üâÀéÈ5#ş'¯"6çêßÄË†¶Š‚„ÕcÊêçû_1
k¥Içß¯“³0 ¬yQÃqÏYµaÊ 5{-Åş^S^‰‹£&…‘xâ–qDîy)°Ù¢öI7~P$‚8Å¾Wu3*¦G,vØ¨"º"0¡“ä‚+Siˆ¾—ëİ$î§+w=‡³ŠŞï¢ÆÆG¡µdÍ[¨àã\ Ì¯lÈm¤š´DUE9†»:¶JÌÇáä‚ ¿h
wz±Œ¹‰Vœ«â sÓ;†¶p4XÁ×ÕaN'>Ğ™%"â ü¶Vriì	‰‹=#T­`mm¥Vj¡ÎÕÍi)}Ä#¦Ëos€ƒ5ÒŞA—\ö²í•ğOxfüˆ_ÿÓã³ï¸8)vó'ùÆ·8>ÙRµ†;ÇZö‚ÃÁ9š¿ıâT÷~D¯±ãL¬›‹…¼9¯“Æ>B³kæ$ó•{Îì£”Û†Z10™<F!\‹-™¯¦ïïÏ¯éÖ§ëáM ~zkyĞîººóv5V:õg	00I¶ŸGó1¶­‚£§¦İ/ÙèÔO½Êï¸ª§k}†ğ]‘\´…Pló¡G>ú„$DÌ5§§ú.ú‹‡‹ä½ô1”¬£îƒó»7¹v(®è˜†
i"«õâFæSxƒäÓiás2Ğ€€ÚjÿÃç®›ªi ÌL² ı²ò£!’4ò'oÏGºòNUâ`4]ÃÓf6Ÿq!šÑÓ;\UØ¢ğ!€wÌ®)sá<Ù@dÙğe`/ğå83ÓŞøËl ³OÚN`¯ÚÔARYª÷ñ¸MqĞpëÒ-"'mÚá±¬¿§wÔåğé{Aæ×é_êD¶“$P‰Œ¨„.ûÆ4o—¼¥“4Ât)Êq¥a¡‹»ˆ´¨*ª­3­ıv5”.IgÍ¢ÿB®1­½2şÖˆ~ı°¥1yôÒv9®…Òwˆ‰1xU(ZL…Q£`èæ­	¨0ÅÚŒ@ñ­_SAë×èû`Ÿ®ñÃg“p´ÆP0®àŒ#âA7†ÑÔdS+Ûu¼½Š.¶C—Êë—Ş$`±ô<+ìÙ©=Åî2WØ&aÓuÉ8ùá(tRyŸÅšµ>£ÿ,æsøÜûk’æYär5šØcD«fSı¯J¬èÊN¬µ]¤ÀEMÎX“ğÂƒ0â[ŞNÕpÁù0~Â›ş–`îl“D]µµ¥b¾pm¡¬Ê0¯NäÛ<wx0?­Ân„cï¸X	¶¥¾‚)Ì9‚É-Û›"n/ 7×äÂ³	·‘!—îõÿTD~ÇßÄÎ>C«B˜.v¹ï!»*«Ô˜îº§tAC>ÉédêqPê"£$k­O]¦GûÔP\a³\÷æ—°ñğ+„Öäº‹l*¶&c1¹šĞzñxàJ²4¬‹±ÑÆ]â L¹’xqGdÅõÚe',¨»›ïáÒy*òç„i-‹*¸r<¤õÖaï¼h0ê/Ş6-ÆÀzXÜ=#PQ¥fy­f“JN}µ‰Õìùm·+mé~ÒôÎb<‘. €u6ÅÇàh¥J\œı¤J²L³¼°²‚‘Ö[r˜[k]ñµ¼ Njn‹]+¨“‘MG©–ÀãŠ3÷K\±ğWís6<ô	›&\x;}ëE¬Î5ÚyNÉåùc">2>Ä²ª1ĞY0ĞaebSšR‡}°èrÕ‚q­OÉXq4Sz$Øw0•Ôá¼”96š}¸µ˜‘!Íë*f<ÀX [3¸cøØ=Â¸øŞÚ}Æ©D«×!f&4|×Ê‹&T°¬2è,Hqãô9ß.g€Í¦á.ä÷…äğñ²„àİş2¡äİğ¬µBÆáéüœ!Ğåëíb½ÀBğÀ˜’¯¢É”±Šæ(]©¥{a	7±ütÖnU2ÂöÑWŸpJ€,½ŠC
h˜ƒ»ÚõÎt—×Ëõ,Wˆğ	ŞiïD&ÆèHÉ ³RŸö>^áÓgë®ôBWş¸l+Cq®&w}êôš2•9Ç9.Ú-2¶´G¿Ù™Ù¢6ñĞß–Æ¶¦yáù‹„ó‘ğ„h•B£1²T´ÆàåĞêWÉ—¯Á¯È¯äN	„æ-¬‡tF\®y"ç~¼Eşr„-­‡¾TÀ‹‰vÖ•|¯$À¦v'èx€…¢%~·*55krÏpÓí~äAÒmR¿pQy¢‚â¬=ÕˆˆÚªû‹–)ĞÏÀl-Y\¦äª:v…:qŠ)¹îï‚y£F€Îì´ßsğt
9¢îê»y¯E 	ïóÃÃĞ¦Ì¹L‹ùÈwË!¹ Ù™ñTŠõw÷0½¤ie=ß9›»¯ø)ÔäXÓæed$£¨~¾Å)§şÕµ-T*Å3…÷{^UhììÏlçÅ6‡À8j‹Ö²tšpz§½š]y„KÏ ¹‚ì–fÎ©êµj­s¸ˆ¯ÂĞ`$f5lîíÎ]ÂEÌ’è·,t­zxƒ£$İßj3@ÌÄ’oxÔ¢X^qRŒâuDÆMK;Ãµ£Ø1`µÈé‰úgµzCsç’´Yã5§ÚÙ%kV››Ä¡¤-—Ç6¬G2ù©Mk–ê‘Zİ&ƒš,¢ÁÖ.<•ŒÇk¶…™‡fuØ7]@p{X×Kø¯‰²ÊØ²î³¿T:OŒlô„£ º"IO•† 
Í–„£cãewé’¾°¸*ØîïÌàÓ­°J½¹x¯Kà.¸•±óèÍÕpp¿ ®ÚâÓË.+Slâê¼¤4««8
zk÷µÀ¤X†Ù.	ôÚÒXõ®€6pp%Õ”F%Ã–Ë§G‚¾ätÍÑ¤¨–ØUÖ³ãÉZ6-àcT(2ZcÂ`#ósóòğ1²ÊW{šÌ8ŞÂW÷Ü•c‰ò¡¾²XçÁ&HiïÊáBåèŞz¶?[5°$ÊúõyË~$$m-eRà”.‡VãXoöÁäVÛzLåEY™í6n&ö¹Aì
^u®³!M¾¤2u°OyÏã]°·­¢^¼Ä ^kH´Ø¡’OÚ]xã7Â£x™lK^ÒsFÌØÒ9.KŒÙSëdıü›=gŸÃæwMÓ uKõM¼`)8T+÷L(µ\ÚmÏ»[:2àí	!®«1/»§rÜç§Áæ~š&R®£*Ø÷1hØ
r†Oe1WC‚'+B«=x,²-å&uú°”š=ƒ070	Î¨“@èâôÄñ4ŸY6ë(Àœ\¾˜WUì-#¶ıu¬X:h5>õı&hC&ÜËe°vF0¾ÏĞ6Œbô»ÅÜuRqv·¯÷ÂùX+s”…8Y0G›UW«o‰')8˜"şÔ£&†5’ÇÏ]&ü’õİ¶èæ³ôñ7Æ/Ma-õÊz8”w	xóÀ]‰¸²\if°ü—nLÂ×ëe¸pÜ±Î°…ñÍ…,`aÅ¦º°œY“~®óøy¡
XXªm#ÅU6?tÅwSá)b;óOY€Eğ;ŞŞI–m²/^&ôkiĞ©—W§%QåRÏeÊæÈ|C_»F±këÕS
LRdôfY®g·Vì!m8Xné‘dÏqsáşpŒİq@£®Ğ]/ê”Ÿ¥e™˜ë¤ÔV¾b$”»Ï|68úkÇä™e?6ö-yó)X…±fÑoËg1$ÇèÆkí&<Û`ÛQ±ÉSİ*÷öÌãäLØ-L[Ûçà"µ*+eàùÅ2rÙ½`¢ıqğöùXÙ9öûI^T Z±Nfá¹&\ä%×an‚TÊ|ÊZ|©4«‚`’À‘ŸÊ ±diË;}«RBĞ>]€ó0ÛŸ¡ª_w\5“Š‰O"úyvb¸&š{hÖYj¸b^hhçKµmW@C`ô	‚JXr;Hå§ĞĞ­ãÅQ0ŒÕÈòÇµÛÃŸ©dNÃ»¯‹ÁÂ~~pø$IÀ™üİ¦³Ûò"àC_‚lĞızs+;Í8‘òœAŸ÷â.wú)Mf¥Ç£:àpõš"B„:ùD!Ï”k?'É<MSƒk°ñ¶1{pÄ.¶ùA6UÓxÇ¢!´B:FW«ÖÅ§u9›ÛÜ9ï8 `BÒx¶¦™J€eªe
Ùx W®³Ü3Î“é^ì±ì@Ëu[òrNAÃwıeSûÄ¶Pie¿Ö‚§æ)»óŞ’7v>¡0¯¹±áÜõëYE{Â‡jáö#Q¹jâKï.Ô2ÂÆ;µíŠïQOô¤p°å“f,a‡,EµÃÑKp¬¾Ì«‚œ™å°f³ŸãÒ¦ê^"‡¯ná(êî…RZzEP¢x"”ï¬û~-Q·Œ•L(Ç2–b<ÄXCq{BÑÊ¹İkóˆ§k½ oŞ0ê:M¥±¸«ÀWFnn¥Şb×A×šóÃ]©5HJãaÜŒÂQO¢½W}ÚàÁûVŸÍ¦õÕSŞ	eQz2WNÔ}½Îu„gx©Î¾“~… V«
µ~qÈœáeèİ„(O°82‚áªŠF‹Wô­–ø¸¬}<XµËÅ¬|jÇ“F'Ì=ûk 	:A°ªè²²lÿ\"&–·ÑwpQÔ”g­¢û"´Äk)Œä`•ú¦š8PïøÁ6×:%ƒÑ¢M×Á´œŸ”(%­lÏ‰ĞÔ¬ş¼üNÎš=]ËnÈ)é*Âş/;Dƒ”T£ˆ½½«Ôà·E-]íX‡Ÿ´â±÷©5~-»¥Ê2­ö\¥¹êuqûjnûù´=ÎéU€ûbÍL,ÑíûÚw;¶¦;C†‚ AsIñÆe5F™wl•³:¾L$‰£…o×•Ñ©æ¶êöDÕ•Jqë:aMè”TK¥¤ñÊÜ^Y±_ø_?+ò˜ùàİı…57Y}Íƒ¼åÉÿú¡~´Ú„ĞKÛ±¹gCÆ~ù8ıláîz11­]´/Ø—¶¸µÓÚvÅKÇà£Kì`Baæ"Ç<éœÀµ7tÚ¯Â¼‰±Î¼·üÆ±˜ß­øúiš¯İ©“°ß^=AHH+Ïfç‘öpI’ø½â_ÓFè%ÚIôüh'¿Ø‡½ÿáÛ!•´å'ƒ€ÂÁ­ššš•Ão·vÎ¬k1ÎJ…@ª}DçF²°I€©-(¼MÆ²…Dô^Õì—xùXèCe_
ÿí&ÿôUï8Š0-÷e¿P€|#iŠ\:®M¡ÏÌÈ<Jx`¯qÄ”d_ØÎ›T2òù°7Ãrì—MH;ÒG¸®#ÙÂ¨çv¹¦MC”T¿ÆAÆwÚ_€}@Ôw 6ù´ÓiBs6šx•^Û>ÌåŸFÍ!Ã*gwI¯—¦Üy®Ç1Í;^ß Òº3†§;çÍ˜—RuÕ¶Ñ—|˜:•I} s±bYƒdã¿ŒÚ­ï§
”ğ&Äÿ<(ÿ@0ÜÜR§=h^GŠqm¾¿)ûı`üâÒoò,”ÕÖ³4Åi•¥çøŞxÙG¯ÿÑÉ`+.BîbÀ´Ò¹Eÿ8²h›çnëûé×ûè0¾;¿l"ÆÜş–ıH’M¤VÏËÎƒŠ®ÈiùFó½Û©Vx¼Nµ^.ıë¾ÚwH‚/ÿ÷´í_Ö˜ )9Àèê²Äõüi2dĞõhı¢º[Ï±Fd»>ÈMÈKwI }Jb.zï+ßî­8ç®Œôø>ŸÀ°¿tÆIÍß.šø2wìJŞ4¸6D—\ø™Çş7üIš¼×Ÿ¹”yĞ´égé”¿¿a+6¯JÉà:=Vÿ“AÌBã(.é¤€äJ=Øğ1ä£Vã`	¦°º%nÆ>OoYmr«T¢çz¨³õøK7ö[ñœÌŸìs˜VšVZ›`sÂì0?Šÿ+’JIQ–Ô”Œ©oÊnÌ’ó’×r).j<º… 0ñÃÎ@¯£=‡j½	²Ô8!6ÔšåÖi:pùÖş_»¿Bô²8SQ	yŞNkœğÉÆ1ìïÜ‡v‰1‡‹šI•l= ä±†{«w½Ï'Pş7”Ô|ı%«íÌmLõ<wF˜‘ÅG/|cğ7¤Äoùßæªó¸ÿû\ËãEqñ"=·7±#[j9U£«pctr÷`+Àã­AU8pŒˆëcşy6ÙïcºXù7è¶!ôøpŞ,Î¤`şV†àa_áSUÚj`ÆãP3ÓRÑ…·º¦¡MJ8¿ùÑå÷ÓN’„²Å%¼nø¿¡ÒHÜX3H1Á}_«ÌOÎªÿèq`ûéø“,È×ñû¹
˜©öpoyºFy¶„rû‚òON"e]Ï†ÀNğ§rŞMş¢ùàNşÓî³“—øİR_²7…o<xşî?Àe¿tÄÖO|iC‘j’räæ~P{±W¸‚uÔ·&B\ƒUÄk ÒÀ'(«İ“Ë¾‘õ«2G²ÒÓ]=G8èû·?e:‰(h©Q«5¦-HØË<qÔ;ÅƒÜIŒõ@iÂ\}7 ²Ô79·F¼v;É@†Qı½#pÜT÷ş}Õ_è4•ƒğÄMö‡X;‹<Ü —.Óºç~¥z!ënº›¿ü/÷ÔËA²~àKÜÿbà:½mUƒ¯×K*&6ßEâ`/z€C¹úù:Ôş&	LO"˜y¼»S~ßVø8ÕY•í‡Î%:Rf«³LŞ9ÕàAïÿ× ë¯q,	ØÍZc?HãYâØ¥ó/÷	ıtˆ³o¨\ÃÙÆ§ ÿ:¹»Aîø á¤é}÷à½¯Y–½³qHÊ”åBÉçh©}/ÅæMÃJ|P¿í­úÅ_ºõ"­şœ©¹˜«Ÿoô™FDöo2á7ƒP[_~·‘wPü½ïÔÌ¿”P›íÌ?|’å£¹ÂwÑ4Œ4§zFƒ6¡TM)S½hîçà¤
#}58y9ŒGĞyëêñ]6üüßòÓ8Zy 2ræÁ„¿Iz~İJøÁ½ã–¿]î~{ p3$ş4CqËXµIÓf=ÙH›]®° –àM¦¤ğPia™HO%hãMûÄÇ
q€\Õ¯&‚Jêìöºü­¦ÁŞ
!Bsûš_(= µ÷ÛÓĞïWö}ğM8/UıªcmĞù;Àøï)ÿ?…µ>-ğ-1
kçM$<Ÿ±ˆ‹ÚÌ/ÑD	k|[kRäŞœ/%0õ1+=å6 J<&ÒÓãÿ©@À)¡r‚0ğ¤l6Ğ~HûÊÖÀşHÁ‡†İÁ­™y9¥UöŠô‘Ö
;t¯ù8Ö¦6»æ(å#¢ü@ğïÔ„´V/²´¾5ğKGvyÛå«P©Gy/ı`¼m#ÙÇ[MôeK‰8h¡¼6Ü’¯}(lWàî£RK$3(Jf4 °7ŞåŸë”±Â•<d–ñ<ô¶ã¼Àyˆç?±~Ò_Ÿ‡šoü³SŞÂgO~mFëw õjú¥ñ*Çº@98gcp¢ôFãÂ¢^Á/ÒV"!ª?ÃQ–DÅ	áÍwÉÍ6º=ÛƒËRwH¿ÂqS¶Á“ƒöÁM¢)Zê×—ÄİÒ»­Y;²úBÄ»sEÍ§Ü!"Í$\icïò­"‹ĞØÑWü8‚‚ |€ÂŒ<MG§’…5CfQ´?=i Q/”'öº?Xñ§Û^?NöfÔ¨:Ÿ¶“gáÚxHË?á÷z}~F (˜K*(¸"±¦ .TİØ:ŸÕ”îæ¥£û[v¸G:®û¥Xl­¿oT)†mj´„÷pTïğT 0@%‹Ïrëp–İåÕ×Æ´ş36Ì4Œ¨şæ²(hæ/b tAvšˆƒïwvC¡@ÃĞîÛH(Änç¶u6„MÄ-ˆaOd§'TüÒÚtãÆİ?ÿH60d6 Ø«¬PÏåûG4áß*»ŒÀÑ7äù7dL¾B„Æ¥ÊsäÎœ¦ºïsæB5]~ß˜	+j‰o[×Ëjş¥mŞ­¡"ÃOùÓ¦¿&Üÿ%&.ü\8rÒRË°¡,£xó¦"ù³ M]©6]CQhËá¨U@Gõ½å å82Vv¿‰CXt€Í«	XmµĞ—-ÙäüüÛ}ÛDII>ã’g¡ßùm$v„^ú3u·z¹ÒÍEÈR=W½Õ¶åì”’‰óX\eO:ÛE”¶ Ém1ªšºY«ı1®Ú€ø¿ıj²O¹aKÍÄâæ	“lï“Å)çÌ^:}Ç¤Îjb<¥ğï3‘ÿ„Å&Dæ¯+»Ù¹ÿN1÷‘#şòÛˆkFQy¢d<,[6…jĞ¬vùeY½“6Õ/œÕƒÈŞ0úÁN*Îû§mFè‘¥š+47ò/Aı8ÀÇ³F®6§åBşçÏJ?ĞëNÅ ‹û£²c›·°Í<o{Î|$ËUı4§¡Ïy¡°„¡ßÂ_&P\9Y	Ÿ¾è›m’š²¯B½`üKÑØÑA®ºÜˆË‡¾®)Ÿ¾×±„íÂoEø6!ÿëù×øJ§M†ÉKö-¯?kò;‡€dÇÙÙ×LÍhnRşTz%9{*l?¾kì¢ì8³ÖbVVú±øÂ*&è?Î¢ß¯¦ …SFqq^öÕyZ0êOÕ¹ò€û°³ ˆùÅi©ú››¹à)ÒŸ2(RÕìg©ÔËè¨•½‡¢£HN%Ü”‡×Ï‹½{«n7ú—Öœüx°}SÓ÷ÄèÿC·‘¶W¿”—bWvÛ\ K"Ğ·DÓnI³>lÌgt™çO}Â÷ÒTOQleûã$;û¥8ãã<Á€À/<ÒÿmÈŸ¼$1¥CØ©WñûÌ-ŞÈ}b»»^R‚DY£Nc2¾scÂ‚qòÈaÛ(˜»9–èBîçwuŒâË”ıBD!ôt-HxËÿ¡òşŸG2¾¶ÉJüÌQŒ’ÚZz>vp@«ÿOq€UçœöM›¶ëW•%‹ú%/SÎÇğa­ ¹¢8ÈmYÓŠLj9¶'’±†1¢òV„+
²4Øjü‡<I–ã[¶ÉˆÑR5‡÷&N4Ëùo®íü×É=ReÕÁ ÏÜM¹§ÏVı¿ù·ĞÛÏ€Kl,›3+C2ÌÜ&æÍ\Dä·ùEj™…*­ÖĞÌ¾ÿUŒ|ûÕdVP/Å®²Rù=æ l_{÷ç;{Š[¸(”©z~¸ô ‘-D¶yiÿb¯R¹ª9˜o“@™WtZ
‘p±h_”—Æ 	JãÖ™éıy ¯‰¯ÿ}·É9‚<bÏÉ_´é\ 4Å%cu«V'EŞNÖ¹¶uÕS¬]_İî«åy>îÿbtş‡»'DvY„|QYP‹Ş¾M`Ÿº]í­ÛR
°
÷$
ÛŸõ,¦lãeç—'vûÕRk]"m5€ ššöÒß·¶Tş<D´S¹ïÙ`ĞÂ÷9» ÿ}¢6áşŸjy4=gbÑÓa¿˜ª|z¤ÖE5ñ1jÌT¦üŞAÈR7MV~ú10­H