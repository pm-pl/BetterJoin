## ⭐ • Better Join

| Version | Status | Date | 
| --- | --- | --- |
| 1.0.0 | stable-dev | 12/10/2022 |

---

## 📫 • General:

 - Plugin Introduction: 

   > This is an advanced player input management plugin on your server that allows you to add several amazing and cool functions, this plugin is just getting started, I still intend to add many more features and make it more personalized, this plugin was inspired by spigot's EasyJoin and reproduced for pocketmine, hope you like it!

 - Suggestions:

   > I suggest you don't enable the setting to add forms and title at the same time, as it will look weird!

   > The command you will use is used by the console, so avoid putting commands that are only used in the game!

---
## 👷‍♂️ • Todo

   > If you want to give money to the player when entering the server use:

```php

# Add money

use davidglitch04\libEco\libEco;
libEco::addMoney($player, $amount);

# Remove money

use davidglitch04\libEco\libEco;
libEco::reduceMoney($player, $amount, static function(bool $success) : void {
});
```
> For more, view: [LibEco](https://github.com/David-pm-pl/libEco)

---

## 🔰 • Features 
 
```
💬 • Join Messages or popups!
💌 • Hidde or customize player join announcement!
✨ • Restore player health and food on join!
🔮 • Teleport player to server spawn whenever they enter!
🔗 • Execute commands when player join!
🎵 • Add sound when player join!
📌 • Add title and subtitle to player when join!
🎯 • Add a UI on player join!
```     
    
---

## 📜 • License

```
   Copyright 2022 HenryDM

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

```
