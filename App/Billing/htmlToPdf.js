/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
var fs=require("fs"),pdf=require("html-pdf"),args=process.argv.slice(2),html=fs.readFileSync(args[0],"utf8"),options={format:"Letter",orientation:"landscape"};pdf.create(html,options).toFile(args[1],function(a,b){if(a)throw a});