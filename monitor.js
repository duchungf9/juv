'use strict';
let gutil = require('gulp-util');
let c = require('ansi-colors');
let redis = require('redis');
const subscriber = redis.createClient(6379, '127.0.0.1');

subscriber.on('message', function (channel, message) {
    message = JSON.parse(message);
    if (message.id === 1) {
        console.log('\n\n\n\n');
        gutil.log(gutil.colors.white('==============> request new <=================================================================='),);
    }
    let timeLog = c.yellow(message.time + 's');
    if (parseFloat(message.time) > 0.7) {
        timeLog = c.yellow.bold.underline(message.time + 's');
    }
    //formart method
    let methodLog = message.method;
    if(methodLog.includes('GET')){
        methodLog = methodLog.includes('200')?c.green(methodLog):c.green.bold.underline(methodLog);
    }else{
        methodLog = methodLog.includes('200')?c.magenta(methodLog):c.magenta.bold.underline(methodLog);
    }


    gutil.log(
        message.id,
        timeLog,
        methodLog,
        c.red(message.ip),
        c.blue(message.url),
        // c.yellow(message.referer),
        c.cyan(message.file),
    );
    console.group();console.group();console.group();console.group();console.group();
    console.log(message.msg);
    console.groupEnd();console.groupEnd();console.groupEnd();console.groupEnd();console.groupEnd();
});

let channel = 'visit_all_slow';
process.argv.forEach(function (val, index, array) {
    if (val.indexOf('--d=') >= 0) {
        channel = val.split('=')[1] + '_visit';
    }
});

gutil.log(
    gutil.colors.yellow(
        '--------------------- Channel ' + channel + '---------------------',
    ),
);
subscriber.subscribe(channel);
