```
 ______              _ _       _          _
|  ____|            | | |     | |        | |
| |__  __  _____ ___| | | __ _| |__   ___| |
|  __| \ \/ / __/ _ \ | |/ _` | '_ \ / _ \ |
| |____ >  < (_|  __/ | | (_| | |_) |  __/ |
|______/_/\_\___\___|_|_|\__,_|_.__/ \___|_|

Version: v0.~~~~1
Usage:
  excellabel  label <path> [options] [--][options] [--]

Arguments:
  path                                   Enter the folder path in " "

Options:
  -p, --label-position[=LABEL-POSITION]  Enter the label position, default: A1
  -i, --label-path[=LABEL-PATH]          Enter the label image path in " ", default: images/label-internal-use-only.jpg
  -s, --label-height[=LABEL-HEIGHT]      Enter the height size of label, default: 50
  -o, --override[=OVERRIDE]              Overding the existing files y/n, default: n
  -h, --help                             Display this help message
```

---

# Excel Labeling CLI

- This CLI currently using on Window so follow the description above we have and exmaple of usage

## Default Usage

- Open you powershell and type

```
$ php excellabel  label "C:\Users\excel-files-folder"
```

- Ouput

```
_____________________________________________________________________________
YOUR CONFIGURATIONS:
  * Your folder directory is ---> C:\Users\excel-files-folder
  * Your label's position is ---> A1
  * Your label's image path is ---> ./images/label-internal-use-only.jpg
  * Your label's height is ---> 50
  * Your output files will be in ---> C:\Users\excel-files-folder\output
_____________________________________________________________________________
PROCESSING YOUR FILES:
⇛  START  ⇚
▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪
⇛  FINISH  ⇚
_____________________________________________________________________________
```

## Options Usage

- Open you powershell and type

```
$ php excellabel  label "C:\Users\excel-files-folder" -p D6 -i "C:\Users\test-image.jpg" -s 80 -o y
```

- Output

```
_____________________________________________________________________________
YOUR CONFIGURATIONS:
  * Your folder directory is ---> C:\Users\excel-files-folder
  * Your label's position is ---> D6
  * Your label's image path is ---> C:\Users\test-image.jpg
  * Your label's height is ---> 80
  * You chose to override the existing files
_____________________________________________________________________________
PROCESSING YOUR FILES:
⇛  START  ⇚
▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪
⇛  FINISH  ⇚
_____________________________________________________________________________
```

## Reference

- [Laravel-Zero](https://laravel-zero.com/)
- [phpspreadsheet](https://phpspreadsheet.readthedocs.io/en/latest/)
