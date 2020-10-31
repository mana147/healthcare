//  value
const express = require('express');
const app = express();
app.use(express.static("./public"));

var server = require("http").Server(app);

server.listen(8888);

// ==================================================
const mysql = require("mysql");
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'iot_database',

});

// ==================================================
// >>>>>>>>>>>>>>>>>>>>>>>>>>> BEGIN >>>>>>>>>>>>>>>>>>>>>>
//  kiểm tra xem có kết nối đến server
// connect()
connect().then(
    function (resolve) {
        log(resolve)
    },
    function (reject) {
        log(reject)
    }
);


// tìm id = value , trong table = user


// Select_id('users', 'id_userhw', ' "us01hw01" ');
//  truy xuất dữ liệu trong table
// Select_table('users');
// Select_table('sokhambenh');

// cập nhật dữ liệu bên trong table

// update_data('users', 'name', 'phamtrung hieu', 'id', '2')
//     .then(
//         (re) => {
//             log('cập nhật database thành công : ' + re)
//         },
//         (er) => {
//             log(er);
//         }
//     );

// end_connect();

Select_id('users', 'id', '4')
    .then(
        (data) => {
            if (String(data).length != 0) {
        
                log(data);
            } else {
                log('data = void ')
            }
        },
        (err) => {
            log(err);
        }
    );

// <<<<<<<<<<<<<<<<<<<<<<< END <<<<<<<<<<<<<<<<<<<<<

// ==================================================

function log(str) { console.log(str) }

// ==================================================
// cập nhật dữ liệu bên trong bảng MySQL
// input :  UPDATE table_name
//          SET column1 = value1, column2 = value2, . . . .
//          WHERE condition (tên cột , toán tử so sánh , giá trị)

function update_data(table_name, column, value, column_id, id) {
    // code here

    let sql =
        'UPDATE `' + table_name +
        '` SET `' + column + '` = \'' + value +
        '\' WHERE `' + table_name + '`.`' + column_id + '` = ' + id + '';

    return new Promise(function (resolve, reject) {
        connection.query(sql, function (err, result) {
            if (err) {
                return reject('err' + err)
            } else {
                resolve('done');
            }
        });
    });
}
// ==================================================

// viết hàm lấy toàn bộ table
// input : *
// output :  data

function Select_table(table_name) {
    let sql = "SELECT * FROM `" + table_name + "`";
    connection.query(sql, (e, r, f) => {
        log(r);
    });
}

// ==================================================

//  viết hàm tìm kiếm theo id 
//  input : nhập tên bảng : Table
//        : nhập tên cột 
//        : nhập số id 
// output : data 

function Select_id(table_name, column_name, value) {

    // SELECT column1, column2, column3, . . . .
    // FROM table_name
    // WHERE condition (tên cột , toán tử so sánh , giá trị)

    let list_column =
        'id,\
        active,\
        id_userhw,\
        name,\
        number,\
        email,\
        level,\
        user_enable';

    let sql =
        'SELECT ' + list_column +
        ' FROM ' + table_name +
        ' WHERE ' + column_name + ' = ' + value;

    return new Promise(function (resolve, reject) {
        connection.query(sql, function (err, result) {
            if (err) {
                return reject('err' + err)
            } else {
                resolve(result);
            }
        });
    });
}

// ==================================================


// function connect() {
//     connection.connect((err) => {
//         if (err) {
//             console.log('error: ' + err.message);
//             connection.end((err) => {
//                 if (err) { console.log('error: ' + err.message) }
//                 else { console.log('\n  >>>>>>>>>> End MySQL server  >>>>>>>>>> ') }
//             });
//         } else {
//             console.log('  >>>>>>>>>> Connected MySQL server >>>>>>>>>> \n')
//         }
//     });

// }
// ==================================================
function end_connect() {
    connection.end((err) => {
        if (err) { console.log('error: ' + err.message) }
        else { console.log('\n  >>>>>>>>>> End MySQL server  >>>>>>>>>> ') }
    });
}
// ==================================================

// In Promise {
//     resolve = giải quyết 
//     reject = từ chối
// }


function connect() {

    return new Promise(function (resolve, reject) {

        connection.connect(function (err) {
            if (err) {
                reject('error connecting: ')
            } else {
                resolve('connected as id ' + connection.threadId)
            }
        });

    })
}

// ==================================================

// let aPromise = new Promise(function (resolve, reject) {

//     log('ok  Promise connect');

//     connection.connect(function (err) {
//         if (err) {
//             reject('error connecting: ');
//         } else {
//             resolve('connected as id ' + connection.threadId);
//         }
//     });

// })

// aPromise.then(
//     function (resolve) {
//         log('resolve = ' + resolve)
//     },
//     function (reject) {
//         log(reject)
//     }
// )

// ==================================================
// connect()

// aPromise.then(
//     function (resolve) {
//         log('resolve = ' + resolve)
//     },
//     function (reject) {
//         log(reject)
//     }
// );

// aPromise.then(
//     (resolve) => log(resolve), 
//     (reject) => log(reject)
// );
