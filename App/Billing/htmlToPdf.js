#!/usr/bin/env node

var fs = require('fs');
var pdf = require('html-pdf');
var args = process.argv.slice(2);
var html = fs.readFileSync(args[0], 'utf8');
var options = {
    format: 'Letter',
    orientation: 'landscape'
};

pdf.create(html, options).toFile(args[1], function(err, res) {
    if (err) throw err
});
