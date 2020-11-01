# XPBottle
A pocketmine plugin that allows players to bottle their xp with a command.

# How to use
1. Download the phar from https://poggit.pmmp.io/ci/TPEimperialPE/XPBottle/~/dev:3.
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

~ Message sent to player if they lack the permission to extract XP:

      no-perms-message-xpbottle: "§cYou do not have permission to extract XP!"

~ Message sent to player if they lack the permission to create an xp bottle:

      no-perms-message-newxpbottle: "§cYou do not have permission to create an XP bottle regardless of XP that you currently possess!"

~ Message sent to player if they lack the permissions to check their XP:

      no-perms-message-myxp: "§cYou do not have permission to check your XP!"

~ Message sent to player if amount specified is below 1:

      must-be-above-0: "§cAmount specified must be above 0!"

~ Message sent to player if the amount specified exceeds the amount of xp the player currently possesses, use %XP% for how much xp the sender has:

      insufficient-xp: "§cAmount specified exceeds how much XP you currently have, you currently have §b%XP%§c!"

~ Message sent to player if the amount specified is not numeric (a number):

      not-integer-message: "§cAmount specified must be numeric!"

~ Message sent to player when xp is extracted successfully, use %AMOUNT-EXTRACTED% for the amount of XP the player extracted into a bottle:

      success-message: "§aSuccesfully extracted §b%AMOUNT-EXTRACTED%§a XP!"

~ Message sent to player if they have 0 XP:

    no-xp: "§cYou have no XP to extract!"

~ Message sent to sender if specified player is not online:

    invalid-player: "§cSpecified player does not exist!"

~ Message sent to player if specified player is themselves. Use %AMOUNT% for the amount of XP:

    self-success-message: "§aSuccessfully given yourself an XP bottle worth §b%AMOUNT% §aXP!"

~ Message sent to reciever of the xp bottle from another player, use %AMOUNT% for the amount given and %SENDER% for the name of the player who gave it to them:

      target-success-message: "§aYou have recieved an XP bottle worth §b%AMOUNT% §aXP from §b%SENDER%§a!"

~ Message sent to the player who gives an xp bottle to another player, use %AMOUNT% for the amount given and %TARGET% for the name of the specified player:

      sender-success-message: "§aSuccessfully given §b%TARGET%§a an XP bottle worth §b%AMOUNT%§a XP!"

~ Message sent to player when they check their XP, use %XP% for the amount of XP they possess:

      xp-success-message: "§aYou currently have §b%XP%§a XP!"

# Support
If you have any suggestions, complaints or need help, leave an issue on github, a review on poggit or message me on discord TPE#1061
 
    
    
