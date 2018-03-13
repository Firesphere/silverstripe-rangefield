# Range field

Play with ranges in your forms in SilverStripe

# Installation

`composer require firesphere/rangefield`

# Usage

`RangeField::create('FieldName', 'Range', {start value}, {minimum}, {maximum}, [array of possible percentages or points])`

Example array for the range settings:

```yaml

['min' => 25, '17%' => 33, '50%' => 50, '83%' => 66, 'max' => 75]
```

The above range will be merged together with the minimum/maximum, where the given array will override the min/max values if set

The field uses noUiSlider as the engine to render the field.
You can look for it's options here:

https://github.com/leongersen/noUiSlider/

# Options


| Option | Default | Method | Usage |
|-|-|-|-|
| Snap | false | setSnap() | Set snapping to points |
| Data | [] | setData() | Completely override the generated data |
| Max | 0 | setMax() | Change the maximum value* |
| Min | 100 | setMin() | Change the minimum value* |
| Densitiy | 5 | setDensity() | Set the density of the Pips |
| Range | [] | setRange() | Set the range* |
| Start | [0] | setStart() | Set the default value* |
| Step | null | setStep() | Set the step size |
| ShowPips | true | setShowPips() | Show pips |
| Snap | false | setSnap() | Snap to the range-set values instead of fluent |


# Known issues

Multiple start values seems not to work properly

# Actual license

This module is published under BSD 3-clause license, although these are not in the actual classes, the license does apply:

http://www.opensource.org/licenses/BSD-3-Clause

Copyright (c) 2012-NOW(), Simon "Firesphere" Erkelens

All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
    Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.


# Did you read this entire readme? You rock!

Pictured below is a cow, just for you.
```

               /( ,,,,, )\
              _\,;;;;;;;,/_
           .-"; ;;;;;;;;; ;"-.
           '.__/`_ / \ _`\__.'
              | (')| |(') |
              | .--' '--. |
              |/ o     o \|
              |           |
             / \ _..=.._ / \
            /:. '._____.'   \
           ;::'    / \      .;
           |     _|_ _|_   ::|
         .-|     '==o=='    '|-.
        /  |  . /       \    |  \
        |  | ::|         |   | .|
        |  (  ')         (.  )::|
        |: |   |;  U U  ;|:: | `|
        |' |   | \ U U / |'  |  |
        ##V|   |_/`"""`\_|   |V##
           ##V##         ##V##
```
