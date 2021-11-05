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
%����
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
x�}<�����8VfV���%de%;�!��Yd#�쑒PH)+{5�����h���u����z�8q>����z����~�?|��zPYM��?�!� �	\(�����R���SQQR�q2�����q0r����'�[D�������nyC�C��z�{厞<�mzPGWBEEEGC���a������w��+ w BR�>�@��D�$� u 
^x����M�(��JDDHv�^i�h�+��$�aO��;�)�bN)�n#�[䔃��m�L�,?����������@IYEU��a}C�#G��O��8ki��tᢳ�%W��~�W�FDFE_��q3�nRrʽ��i����>)*+������}�����]k[{G� rphxdtl|vn~aqi��J�L@H%$Y'B��4�m&�U�!9iO�c�7)�b����-\"�(�S�d۸E��]�z��o������O$�K Rʇ[�P�v�����; 
( ��� p`���������+S�I׎lll�^F�lB��)ftN�V\q@��ˤ�Gn�㲏���*�p��[.�7�a�2��k�=|߀p�rY�����Yz���2?�`}�ƣ�@8���&���V�|��Z_�u�J� uv51�p����Ȣ�'|va�����بi5�õ�̔W#��ezG^�!�P���o�s���e]�W.�'�~SNR�o��ܓ<%�)Θh��\��{�U�N ��n�!��MJ$̏��k�w��b�ǉ�9��k͸��^���>�E�"N����/��c>i�Y������Y��4����Xa[T��.�:��i<0�
�'h��b�%h���C��Rm,=�t{�U;�$>�6sn*@k�oqSN�!��U˭SW���Ӽ�N�]��5p&����Six lE��q�;ǅ�&��<΃$�Lh�NeYx��:Ir�N�D��˥�G��í�`���W�lח֚z�ĥ��S<�pd�=�4i�R�nQe�{���	,/���m�x��vm�R�#�����	o����ک:+z�"V�y�o�J� �Dqi& �;�Q?>����!ן49��%�y��A<P��hbo��`dCѩD
b�k�v&���l��Em$l:V.c��x��5�*��K���d�y�H�x��q��F�l��BIT�~�Ԇ�"�m��L��44�����)���d�������G/wÈ���}���)7�"��4m�)3��+�S댐Ѧ�3\&/X�R�+.B����!��s�@Qo4뱵Թ�E�◸aF��1C8�?ߌ�
7�������g��*��^���iN���w.��%m|��6�S6*.�x�+lA�GN}d�dYhظ�e�\/nEt��'e&="����\u|vZmip�<�/�yD��^:�6c��컣�஬]��D��-*��֣C��6 f��j��j��|g�1�{��+c�Ax���>���Oż�����3sBL]C��jQ9F~�yÍ\�~���fY5Z�fں���5y��7sP��̍��\q��sA�I�-Z��I~�e	��t<аw��@�:���=N��g?'Y��gN [k�ٌ� $���A�ѺK������������7�@�ax��Ӊ5o����|nc2�a��6�ES�~�F1�փ/`K ���G�~��jF|��,( ���#�X%�E���~ �`FI��EJV}��<�B	�����͂*�H� �g���3�T�y�v��z�P��E5��Q�A'�.#PI���O��� Ѱ�H���B�*�	�ۣvV�.6�$��$���b�e�����1�T��5�N=��G?�;��H��z}1*t�@���6��$��,$�!I��`%qU-��5�5Ugj��b�*�
�&G�����ײ�n_� ǉl���� {D?{+b��>8�]�`�P��Oc̫&����LWpP8Z���yp�&�ǌ�N0��g�CA��!�����a�k��R��8Յ��bfήz�v�ч-T[Z�n�O@~��<���&ߎ��X��L�?9?h�$���aӷZ�ۯ��2)��:�l�N$U����z��� ��FCN�Ja�
�k�h����,&��@� �>�� �H욯�6;��L������O��<.I�YJ�1)�vɆ��_ר&]������Ee���V�����G�	Z�?����I}�/�Ώ��Q����	�_K3��.D�=�D~c�ۜa�c�e����	--��涻&Qt��B2��Eڽ���6m�����:`Ww�.��x�z	��̤�Ptt�|3�OJSl��j%l�ĕ�lѓ��^ؚ3��+'�0�1銽���~J=A�1�߃�X���,�a���k;� |qrv�OI6@ϸF��D叐nc��B>���y�� *X�tH�K��z}�zw���nH�XN�J	�)�-#��+����!�)��P�~Tټ��v���d�(Os}���r�t���M�u�RO�8E��A����"��{�;y[z�a<�����a�t/��ӾNA��G�A��t�m�n�P��Jc�Tq�����*ѓӉ-��,���v_��G����Q���x��˰K�I��hL�d�\B����ޘU���f-�Zk?(|l;����x���>~��+���i��H�_����<��bmq�h]�Y�\cP�A�0|Ǐ߇�37�G��"���߽��pY&p���<�-mG�T/	`�&�d9z�,��v�;Dp�{�L���AqD :i����n��?���nG.y���Mrucg0x�D�Q��l� �*-R~��i?��Jȏ9�,8G}�cf1C���-amKh��,8�2�~P"*�����&�Q��K:�k�+��r���`���(CL'�.�
��{�.+9���6��oA�	c�I�{��D��A��y1�ς0J8λ0�4Ni�cY_$6�>U�np'�wlUE�W/�.�\2AS j<�\�N���P�X�Sx�E/�,8;�2<��%���?����_k+F����i�68ѤRf�<i n�v6e���O�|O��ϳ���)<`2��W&�v��Xj16�;��������8ngV��L��}>�ǋ��Ɣ��	��+7��f���#�Y>o34
[ l.F1�ˮE���`i o� M�&�3\ؿ@Ϻ����LC\V=/9�I\?���9�G�i�K� �i�-pUA���P��pp\P��˼����U�b4YB?�b>�6����_�*�	ׄ�u���1�ܵ�݈~unþ��%	��7��s��w��w*��'�D�!_thv��?p@�6p��]��3�����m�m(�ߤo������U>w��(�J�!:��A������	�D_P��|?N��J$��~ڗ4�W:�869�
�σ���;����'��,���=J\�0�|"x�(�HD4l�d]���Yׁ����e�I��7N�]�Ӽׇ���Sq ��K� �O;	N5���+��u�o>�U��:.�A��Y��f�V�9���vy �0TȨ�Q��c��Zv�@-b�B�f�08�5Ϋ�y]�����f����a!�-RX��H�]uՔ9��8��CƾkP%Y'8�f�>��i �)e*b]�Ì2133'_>]���X��d�7Qϰ�A��Iн�D!hA9	��m��z���u��&�}�p����@>��֎&�~O��9�/���8�*�W�m������{?���;�:�,���e�w�u��cӤආ+	=�@\��@lޫ(^pVP�'����JoOy49��.4<i�)���ZU�ܱ�������
=�x�{����������F��9 �����j#�K��U�P�u����-��ª�	��p�����5F5vѧ��r5W�e ��k�/�/~�8��V��%�D���eQg;T�RکS�@�j����w�ɱ�)f����vg���a[�xC��1�2��������!��Ua��ӡ�}���9���[��aU�>ܣTL�4;6&�f�W��7A�RJ�8=ʇ-�"�R;�",��'�b�]���S�I�����2=���⁉a�ڴ��V�7�y&\�g���P�t��i�I��.ߚ ��H�
�]� �f�G�B~��v��-���s�E�ѻ=�c<��e?�L�xw�J�g�}!41y�]o��{��֣��ۑ��s;K½��Z[�g���w��`��ф�rq�!��bCTyþ?��D����?����ⳓ�e��6��,$��	$�׆(���ٍx �X��&���ǁ�~ef2!"�Od%+O��:�4Ŭ����{ΥՌD�m�*!ǩ���f�'۞�S2�5�	����ݺ��jd���ڻ��d�*=�_��4=@ǾS<�w����>��+Q�G�sT62u��țC������v��W��/�X����L�V�&��?����W�G���{�Z�D)OyvM���G!g���c��<E}?�讗�b���cM<����1�ݬ����͸՝#�nNؑ���{?jP������ߕ����WB\_{��w���!�j�FDwc7p��#I�;���g��]6��23,������z�0]�pA��(SY�Il�m10�Pu-�l� �O��YL��,�~�ĨĺUs�����ʒ�|]mqD�8�����*���Hy(�s�2����i�ca�wX�����À*96*õ�!}����kN�W���?��TsC����S�v�覻z�^�wq��'�.�;+�9����h�����M�N��������3#�n� 9��37�a���#�"6�)����D�y:���u�Eг���=�[Yw����*l>{�,��슞����iuU�.������:��*�q8*��<�x�8"���y�dw�T]��V{=�,�G��w�T�]���}�K�f{���o����`��=�G�f�h� �#��R��k~N��x����(A��(�Q�u.�̗�fj�M5������2�%G���<�#��x��U(n�+�YD�D����������[�r�%����Aid��k4K��_�O�^�㚭܇�e�@�jq�3[Gf�v��j0�ZcC�l�^��`�Q��!պ.�oM�\�`�2CCUv�y��S����ۛ�{�N�pv@!d����0��4�;SāFB 4e�x��L�g���T)~��iG�Q��	Z%O&a)sve%�ȐqMw�U��!f;��<:�;b�0ր��^4>df�?S�56U�k�^z��;�6<k��+T�>�z$��QiͿȋ����;�4�+�+�0\\��v��=���1��j��B��,y��x��v�X���`��;�0�A�	<� �;��b�V��,WlW�U<�f�5J1K�`ϧv�Ӣ_|2���<�Gq2$m�:��h+�SR+�о���T��_�Y%+F!p"����.͹���̙�y�+��X�U�RX�+����ȋW�r7�F!��u���d��A�%-�YH��<���ԜNLGh����%��ѕ��z皩��{��梂AWtO7(�]H�%Gr��ay��ݎaa>gGAI�*nN�Ӟ�͠w<}QV/`)�<"7vp$��}o�s�����q���<�w:.̧;Q%��rz�ڵ |C�9g���UAs�т�	�� �X�
.�v�b?���H�\���ip�1�a%
�H���%(3;.��%y/�& �pG��ӄ˂(Z���~��onK-^��������兗c�n��n�'�7����<y�Df��R��Y�=1� ���r7]�1���]|�d��N�O��С ���Ӣ6F��nmC�'S
|���[�~Lx�О��g�;��9�/_�G����}<Z�]��v\�1��H�~�Ľ���̲_���o)�V̕r��D��	��^iU8Ҙ C�}C�(�]NQF[2��Q�U S��o��]j��yk9=,wƗ��$ܰ�Q�
^>����p����<��(�ɻ��&�[㣪���4`p2��dgt�d�6�E���Qsf��	]>�����$X&۫B�pT�(WV���9�@�`�Aטx�C����@��6c�h��v�@/�򥷙���I��Rcy��V˯���j����5�*�U�.��L	��-�/3�%����N�x�i�9P��j��$�>��1/*$�;�MO������
�2n� �� ��`���3�6�S���C�-�w['�8��p,�*G<^�h�9�x��r��1fٰ���8���Ö����.�I4'q�i$��b�9���Ԗ��ۖ�n<�D��#�l��SSw&pk���(��UJ��ii��L��j���n��? M�J�Mz��9�w�q�⮥Tv��N�z�e�u�y-5d��\5���g�k����]����/�]�Rݦ�ϻjN���\�W��yC�u�6:ë�k7�Md�A�o\����M B�&$��Þ^K�TI����]�XJHބ_��;��]�;��o؊�����S����a�2ٌ�v�l��	"�ѳC�f�"\�Ě��]���R��JG�}�ǚ։��`���\�o�i���pz�X�����l��`)�LTy�GDJeE��dm@91�'e��CL�˱J���H��xG����ē�����aktPW���<Ro�!��J�6�v��W	����_)\.�D [���{3���DU<U���p�8��T7�V�w�P~&kM���'�!�}Aʚԅķs�4�I��x}�&���p�U����zxn�a2	ֲeZYΨ��f&�e�[ U<W�A���TN�ڶ�[�؅D\4O��ҳ�%���r�St�	k��lW���$N�)!��:[�=�00֦ak<�ލx��mT�e�tА���0y
��-��U�(�ܵ
wX��t���W���%Ӻd�v�}a��ټg��.* Tk�:�9�n���U0C���ՀCa�+U�E�'F�'�ROw�r���ޜ�N(q��0�2��7{�ak��.�6��t+'���m�x����dB��@�\Wywb����׮[�LR� �|I�е�1����W���x�4�v&��Bi���I�V���8{Oc=�j���굤(�YK��3��a����wR�q;Ι�`dz�.+ݏ�@{7����[�զ櫌�1��+t��/�N'D�$gD$\Q�����<��ю��v۪b$���v40�1L�(�U=>U<=6�=}?�sI>�j����!!J���U�,�p�8��� ��К�$\լ�r
���ޓ���:Əw�_!�]
ex�Z�}���[�}�}�)S�jf�#�ؓ��^j�1��N5bmg&�|�Zfndր,xk/�$��s%o��^}�ք��Jg;��I���w�Wj�8��K��O+bF�{��2/TO��g���m��������%�=FV.��O1�8:Jh����o
4���v3i���,��j��og�%]��yW��YhЈe1��$�l`z
��63�Ns�$N�%ʄl�z6�Ce����J��}���L�sa%���-J��V�)���qV/�sYa�Ֆ%S�U#������)-��d�����ڈY{�f�jQ��V�LӪ]�/�ſ�E����t��5v*���ىK
��뉰7��@�gV�D���:7��N��XuO�j!������5#�'�"6����ˆ�����c����_1
k�I�߯��0 �yQ�q�Y�aʠ5{-��^S^���&��x�qD�y)����I7~P$�8žWu3*�G,vب"�"0����+Si�����$�+w=��������G���d�[���\�̯l�m���DUE9��:�J���䂠�h
wz����V���s�;��p4X���aN'>Й%"� ��Vri�	��=#T�`mm�Vj����i)}�#��os��5��A�\����Ox�f��_����8)v�'�Ʒ8>�R��;�Z����9����T��~D���L�����9���>B�k�$�{�죔ۆZ10�<F!\�-������������M� ~zky��v5V:�g	00I��G�1�������/���O��︪�k}��]�\��Pl�G>��$�D�5���.������1�����7�v(�蘆
i"���F�Sx����i�s2����j��箍��i �L�����!�4�'o�G���NU�`4]��f6�q!���;\Uآ�!�w̮)sខ<�@d��e`/��83����l� �O�N`���ARY���Mq�p���-"'m�ᱬ��w����{A���_�D��$P����.��4o����4�t)�q�a�������*��3��v5�.�Ig͢�B�1��2�ֈ~���1y��v9���w��1xU(ZL�Q��`��	�0�ڌ@�_SA�����`����g�p��P0���#�A7���dS+�u���.��C����$`��<+�٩=Ł�2W�&a�u�8��(tRy�Ś�>��,�s��܍�k��Y��r5��cD�fS��J����N��]��EM�X��0�[�N�p��0~����`�l�D]���b�pm���0�N�۝<wx0?��n�cX	����)�9��-�ۛ"n/ 7��³	��!����TD~����>C�B�.v��!�*�Ԙ��tAC>��d�qP�"�$k�O]�G��P\a�\������+��事�l*�&c1���z�x�J�4�����]�L��xqGd���e',�������y*��i-�*�r<���a�h0�/�6-��zX�=#PQ�fy�f��JN}�����m�+m�~���b<�.��u6���h�J\����J�L�������[r�[k]� Njn�]+���MG����3�K\��W�s6<�	�&\x;}�E��5�yN���c">2>Ĳ�1�Y0�aeb�S�R�}��rՂq�O�Xq4Sz$�w0��ἔ96�}������!��*f�<�X [3�c���=�¸���}��D��!f&4|���&T��2�,Hq��9�.g�ͦ�.�����������2����B�����!����b��B������ɔ���(]��{a	7��t�nU2����W�p�J�,��C
h�������t����,W��	�i�D&��H� �R���>^��g��BW��l+Cq�&w}���2�9��9.�-2��G�ٙ٢6��ߖƶ�y�������h���B�1�T������W�����ȯ�N	��-��tF\�y"�~�E�r�-���T���v֕|�$��v'�x���%~�*55kr�p��~�A�mR�pQy���=Ո�ڪ���)���l-�Y\��:v�:q��)���y�F����s��t
9����y�E 	��������̹L���w�!��ٙ�T��w��0��ie=ߎ9����)���X��ed$��~��)��յ-T*�3��{^Uh���l�ō6���8j�ֲt�pz����]y�KϠ���fΩ�j�s�����`$f5l���]�E̒�,t�zx��$��j3@�Ē�oxԢX^qR��uD�MK;õ��1`����g�zCs璴Y�5���%kV�����-��6�G2��Mk��Z�&��,���.<���k����fu�7]@p{X�K����ʏز�T:O�l􄣠�"IO����
͖��c�ew钾��*�����ӭ�J��x�K�.���������pp�������.+Sl�꼤4��8
zk������X��.	���X���6pp%ՔF%Ö˧G���t�Ѥ���Uֳ��Z6-�cT(2Zc�`#�s���1��W{��8ސ�W�ܕc�򡾲X��&Hi���B���z�?[5�$���y��~$$m-eR��.�V�Xo���V�zL�EY����6n&��A�
^u��!M��2u�Oy�㎞]����^�� ^kH�ء�O�]x�7£�x�lK^�sF���9.K��S�d���=g���wMӠuK�M�`)8T+�L(��\�mϻ[:2��	!��1/��r����~�&R���*��1h��
r�Oe1WC�'+B�=x,�-�&u����=�070	Ψ�@�����4�Y6�(��\��WU�-#��u�X:h5>���&hC&��e�vF0����6�b����uRqv�����X+s��8Y0G�UW�o�')8�"�ԣ&�5���]&���ݶ����7�/Ma-��z8�w	x��]���\if���nL���e�pܱΰ��ͅ,`aŦ���Y�~���y�
XX�m#�U6?t�wS�)b;�OY�E�;��I�m�/^&�kiЩ�W�%Q�R�e���|�C_�F�k��S
LRd�fY�g�V�!m8Xn�d�qs��p�ݐq@���]/ꔟ�e����V��b$���|68�k��e?6�-y�)X��f�o�g1$���k�&<�`�Q�ɞS�*�����L�-L[���"�*+e���2rٽ`��q���X�9��I^T�Z�Nf�&\�%�an�T�|�Z|�4��`����ʠ�di�;}�RB�>�]��0۝����_w\5���O"�y�vb�&�{h�Yj�b^hh�K�mW@C`�	�JX�r�;H��Э��Q0�՝��ǵ�ß�dNû����~~p�$I���ݦ���"�C_�l��zs+;�8��A���.w�)Mf���:�p��"B��:�D!ώ�k?'�<MS�k��1{p�.��A6U�xǢ!�B:FW��ŧu9���9��8 `B�x���J�e�e
�x W���3Γ�^��@�u[�rNA�w�eS�ĶPie�ւ��)��ޒ7v>�0�������Y�E{j��#Q�j�K�.�2��;���QO��p��f,a��,E���Kp��̫�����f���Ҧ�^"��n�(��RZzEP�x"���~-Q���L(�2��b<�XCq{B�ʹ�k�k��o�0�:M�����WFnn��b�Aך��]��5HJ�a܌��Q�O��W}����V������S�	eQz2WN�}��u�gx�ξ�~��V�
�~qȜ�e�݄(O�82�᪊F��W�������}<X���Ŭ|jǓF'�=�k�	:A��貲l�\"&����wpQԔg����"��k)��`����8P���6�:%�ѢM������(%�lω�Ԭ���NΚ=]�n�)�*��/;D��T�������E-]�X�������5~-���2��\���uq�jn���=��U��b�L,����w;��;C���AsI��e5F�wl���:�L$���oוѩ���D��Jq�:�aM�TK�����^Y��_�_?+������57Y}̓������~�ڄ�K�۱�gC�~�8�l��z11�]�/ؗ�����v�K��K�`Ba�"�<���7tگ�����μ��Ʊ�߭��i�������^=AHH+�f��pI����_�F�%�I���h'�؇�����!���'����������o�vάk1��J�@�}D�F��I��-(�M�Ʋ�D�^��x�X�Ce_
��&��U�8�0-�e��P�|#i�\:�M����<Jx`�qĔd_�Λ�T2���7�r�MH;�G��#�¨�v��MC�T��A�w�_�}@�w�6���iBs6�x�^�>��F�!�*gwI�����y��1�;^� Һ3��;�͘�Ru��ї|�:�I} s�bY�d㿌ڭ�
��&��<(�@�0��R�=h^G�qm��)��`���o�,����4�i�����x�G����`+.B�b��ҹE�8�h��n������0�;�l"�����H�M�V��΃���i�F�۩Vx��N�^.���wH�/����_֘ )9������i2d���h���[ϱFd�>�M�KwI }Jb.z�+���8箌��>����t�I��.��2w�J�4�6D�\����7�I��ן��yд�g锿��a�+6�Jɝ�:=V���A�B�(.���J=��1��V�`	���%n�>OoYmr�T��z����K7�[�̟�s�V�VZ�`s��0?���+�JIQ�Ԕ��o�n̍���r).j<�� 0���@��=�j�	��8!6Ԛ��i:p���_��B��8SQ	y�Nk����1��܇v�1���I�l= 䱆{�w��'P�7��|�%���mL�<wF���G/|c�7��o������\��Eq�"=�7�#[j9U��pctr��`+���AU8p����c�y6��c�X�7�!��p�,Τ`�V��a_�SU�j`��P3�Rх����MJ8�������N����%�n����H�X3H1��}_��OΪ��q`����,�����
�����poy�Fy��r���ON"e]ϐ���N�r�M����N������R_�7�o<x��?�e�t��O|iC�j�r��~P{�W��uԷ&B�\�U�k ҁ��'�(�ݓ˾���2G��ӏ]=G8����?e:�(h�Q��5�-H��<q�;Ń�I��@i�\}7���79��F�v;�@�Q���#p�T��}�_�4�����M��X;�<ܠ�.Ӻ�~�z!�n����/���A�~�K��b��:�mU���K*&6�E�`/z�C����:��&	LO"�y��S~�V�8�Y���%:�Rf��L�9��A��� �q,	��Zc?H�Y�إ�/�	�t��o�\��Ƨ �:��A�� ��}�཯Y�����qH���B��h�}/��M�J|�P����_��"��������o��FD��o2�7��P[_~��wP����̿�P���?|�����w�4�4�zF��6�TM)S�h����
#}58y9�G�y���]�6�����8Zy 2r����Iz~�J����㖿]�~{�p3$�4Cq�X�I�f=�H�]�� ��M����Pia�HO�%h�M���
q�\կ&�J���������
!Bs��_(= ������W�}�M�8/U��cm��;���)�?��>-�-1�
k�M$<�����̎/�D	k|[kR�ޜ/%0�1+=�6 J<&�����@�)�r�0��l6�~H�����H�������y9�U�����
;t��8֦6��(�#��@������V/���5�KGvy��P�Gy/�`�m#��[M�eK�8h��6ܒ�}(lW��RK$3(Jf4��7��딱<d��<����y��?�~�_���o��S��gO~mF�w��j���*��@98gcp��F�¢^�/�V"!�?�Q�D�	��w��6�=���RwH��qS�������M�)Z�ח��һ�Y;��BĻsEͧ�!"�$\ic��"�����W�8���|���<MG���5CfQ�?=i�Q/�'��?X��^?N�fԨ:���g��xH�?���z}~F (�K*(�"���.T��:�Ք�楣�[v�G:���Xl��oT)�mj����pT��T�0@%��r�p�����ƴ�36�4����(h�/b tAv����wvC�@����H(�n�u6�M�-�a�Od�'T���t���?�H60d6�ث�P���G4��*����7��7dL�B�ƥ�s�Μ���s�B5]~ߘ	+j�o[��j��mގ��"�O�Ӧ�&��%&.�\8r�R˰�,�x���"�� M]�6]CQh��U@G��� �82Vv��CXt�ͫ	Xm�З-�����}�DII>�g���m$v��^�3u�z���E�R=W�ն������X\eO:�E�� �m1���Y��1�ڀ���j�O�aK����	�l��)���^:}Ǥ�jb<���3����&D��+�ٹ�N1��#��ۈk�FQy�d<,[6��jЬv�eY��6�/�Ճ��0��N*���mF葥�+47�/A�8�ǳF�6��B���J?��N� ����c����<o{�|$�U�4����y������_&P\9Y	���m����B�`�K���A���܈ˇ��)��ױ���oE�6!�����J�M��K�-�?k�;��d����L�hnR�Tz%9{�*l?�k��8��bVV�����*&�?΢߯� �SFqq^��yZ0�Oչ���� ����i������)ҟ2(R��g����������HN�%ܔ��ϋ�{�n7��֜�x�}S������C���W���bWv�\�K"зD�nI�>l�gt���O}���TOQle���$;��8��<���/<��mȟ�$1��CةW���-��}b��^R�DY�Nc2�scq��a�(��9��B���wu��˔�BD!�t-Hx������G2���J��Q���Zz>vp@��Oq�U��M���W�%��%/S���a����8�mYӊLj9�'���1��V�+
�4�j��<I��[�Ɉ�R5��&N4��o�����=Re�� ��M���V������πKl,�3+C2��&��\D��E�j��*�������U�|��dVP/Ů�R�=��l_{��;{�[�(��z~�� �-D�yi�b�R��9��o���@�WtZ
�p�h_��Ơ	J��֙��y�����}��9�<b��_��\ 4�%cu�V'E�Nֹ�u�S�]_���y>��bt���'DvY�|QYP�޾M`��]��R
�
�$
۟�,�l�e�'v��Rk]"m5������߷�T�<D�S���`���9� �}�6���jy4=gb��a���|z��E5�1j�T���A�R7MV~�10�H