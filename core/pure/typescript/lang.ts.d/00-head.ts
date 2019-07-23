/*
    The Language
    Copyright (C) 2018, 2019  Zaoqi <zaomir@outlook.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.

*/

function LANG_ERROR(): never {
    throw "TheLanguage PANIC"
}
function LANG_ASSERT(x: boolean): void {
    if (!x) {
        return LANG_ERROR()
    }
}

type OrFalse<x> = x | false

type TrueFalseNull=true|false|null // null一般表示未知。

/* 一些命名规则
  _p 判断。一般返回boolean。
  _p3 判断。一般返回TrueFalseNull。
  _rec 递归。
  k _k 表示Continuation。类似Scheme的Continuation。
/*

/* !!!Racket Code Generator!!!
   (string-append "////RktCodeGen" "Example")
*/
// !!!Generated by Racket!!! !!!BEGIN!!!
////RktCodeGenExample
// !!!Generated by Racket!!! !!!END!!!
