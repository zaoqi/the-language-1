# The Language

[![pipeline status](https://gitlab.com/the-language/the-language/badges/master/pipeline.svg)](https://gitlab.com/the-language/the-language/commits/master)

位於 https://gitlab.com/the-language/the-language

## 名称

* 标识 `TheLanguage`

## 文檔

https://the-language.gitlab.io/the-language/

## 編譯，運行，測試

可以用`./builder-containers/docker/run.sh`以在Docker中编译。

* 編譯 `./make.sh`
* 測試 `./test.sh`

### 依賴

見[core/pure/README.md](core/pure/README.md)

## .git/config

```
[core]
	repositoryformatversion = 0
	filemode = true
	bare = false
	logallrefupdates = true
	precomposeunicode = true
[remote "origin"]
	url = git@gitlab.com:the-language/the-language.git
	fetch = +refs/heads/*:refs/remotes/origin/*
	pushurl = git@gitlab.com:the-language/the-language.git
	pushurl = git@github.com:the-language/the-language.git
[branch "master"]
	remote = origin
	merge = refs/heads/master
```

## 實驗性特性

* 使`能否實現一個總是停機的解釋器`成為未解決的數學問題
* `...`

### 使能否實現一個總是停機的解釋器成為未解決的數學問題

* 直覺上還能描述所有可计算算法。但和Turing机不等价。
* `值`：頂層是類似`cons` `null`等東西的`表達式`。`值`的定義同The Little Typer一書中的定義。
* `解釋沒有值`：允許解釋器解釋一部分或全部`沒有值`的`表達式`爲某種`錯誤`（`錯誤`是一種`值`）。要求儘量減小（這個`儘量`還沒被精確定義）被`解釋沒有值`的`表達式`的大小。
* `沒有值`：`解釋沒有值`任意次以後，如果不繼續`解釋沒有值`，不能化簡爲任何`值`的`表達式`。含有`有沒有值`無法判定的情況。
* 一次`解釋沒有值`可以解釋任意個`表達式`。
* 暫時沒有不可判定的情況。上面的"含有`有沒有值`無法判定的情況。"暫時沒有用處。
* 每一層`eval`都沒有判定這個`eval`本身一個表達式是否`沒有值`的函數。只判定被解釋的`表達式`在某個狀態下（`解釋沒有值`任意次以後）是否`沒有值`。

#### 可以接受的後果

* 一個`表達式`可能有多個合理的`值`。比如`(letrec ([x (car y)] [y (car x)]) x)`
