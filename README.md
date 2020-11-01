# XPBottle
A pocketmine plugin that allows players to bottle their xp with a command.

# How to use
1. Download the phar from 
2. Upload to your servers plugin directory.
3. Restart your server.

# Features
- Players can extract XP into a bottle.
- Ability to create newxpbottles regardless of XP through both players and the console, this allows the bottles to be in kits and crates.
- Players can also check their XP.
- All messages configurable in the config.yml!

# Commands
- /xpbottle <amount> - The user of this command has XP extracted from them and put into a bottle.
- /newxpbottle <amount> <player> - This command can be run by both console and players, whatever amount specified will be given as a bottle to the
  specified player.
- /myxp - Informs the user how much XP they currently have!

# Permissions
- xpbottle.xpbottle.command:

      default: true
      description: Allows players to use /xpbottle.

- xpbottle.newxpbottle.command:

      default: op
      description: Allows players to use /newxpbottle.
      
- xpbottle.command.myxp:

      default: true
      description: Allows players to use /myxp.
# Config

# Support
If you have any suggestions, complaints or need help, leave an issue on github, a review on poggit or message me on discord TPE#1061
 
    
    
