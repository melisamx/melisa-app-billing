/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
module.exports=function(a){a.initConfig({main:{appName:"Billing",src:"resources/assets/",output:"../../public/<%= main.appName.toLowerCase() %>/",proyect:{name:"Melisa Billing",version:"1.0.0",company:"Melisa Company"}},less:{options:{compress:!0},all:{files:{"<%= main.output %>css/documents-preview.min.css":"<%= main.src %>less/documents-preview.less","<%= main.output %>css/accounts-receivable-view.min.css":"<%= main.src %>less/accounts-receivable-view.less"}}},sass:{options:{style:"compressed",noCache:!0,sourcemap:"none"},all:{files:{"<%= main.output %>css/style.css":"<%= main.src %>sass/materialize.scss"}}},watch:{files:["<%= main.src %>less/**/*.less"],tasks:["less"]}}),a.loadNpmTasks("grunt-contrib-less"),a.loadNpmTasks("grunt-contrib-watch"),a.loadNpmTasks("grunt-contrib-sass"),a.registerTask("default",["watch"])};