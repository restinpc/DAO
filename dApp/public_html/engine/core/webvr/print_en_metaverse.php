<?php
/**
 * Prints an metaverse whitepaper.
 * @path /engine/core/webvr/print_en_metaverse.php
 *
 * @name    DAO Mansion    @version 1.0.2
 * @param object $site Site class object.
 * @return string Returns content of metaverse whitepaper.
 * @usage <code>
 *   engine::print_en_metaverse($site);
 * </code>
 * @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 *
 * @var $site->title - Page title.
 * @var $site->content - Page HTML data.
 * @var $site->keywords - Array meta keywords.
 * @var $site->description - Page meta description.
 * @var $site->img - Page meta image.
 * @var $site->onload - Page executable JavaScript code.
 * @var $site->configs - Array MySQL configs.
 */
function print_en_metaverse($site) {
        return '
<h1>VR/AI game</h1>
<p>
    The final stage of the startup will be the development of a VR product that will use tokens as an internal currency, and as a result, increase the value of both tokens and cryptocurrency in general.
    The development of this product can only be fully started when everything else is ready, since this product will require just a huge resource.
</p>
<p>
    There is design document of Multiplayer Game in VR context, with king of hill mode 
    Half Life Alyx + Population One + Mascarade Bloodhunt + Darwinia with a gamable blockchain motivation.
    Basicly, every skill requre token mana with same as Bloodhunt mechanics. 
</p>
<img src="/img/metaverse/splash.jpg" width="100%" style="float:right; max-width:350px; padding: 10px;"  />
<ul>
    <li><a href="#1">Terms</a></li>
    <li><a href="#2">Environment</a></li>
    <li><a href="#3">Skills</a></li>
    <li><a href="#4">AI and Bots</a></li>
    <li><a href="#5">Project Scope</a></li>
</ul>
<h2>Terms</h2>
<a name="1"></a>
<ul>
<li>1) Imperative - analogue of a bitcoin miner</li>
<li>2) Irritant - analogue of a computer with an internet</li>
<li>3) Tokens - analogue of mana</li>
<li>4) Realm - analogue of the planet</li>
<li>5) Temperature - the global state of the realm</li>
<li>7) Corpse - uninhabited body</li>
<li>8) Fallen - inhabited body (it is inhabited before disconnect or other mechanics)</li>
<li>9) Lobby - a space for choosing realms</li>
<li>10) Mining - providing GPU power for a number of tasks (bots, realm generation, background image generation)</li>
<li>11) Neural interface - drawing layer, as in Darwinia game</li>
<li>12) Color wallet - a way to store tokens in the context of the realm, but without direct access to them from the game</li>
<li>13) Trojan - an analogue of the firmware, when part of the hashrate goes to the hacker</li>
<li>14) Energy entitie - a projection controlled by a person or a robot with increased speed and levitation turned on by default (like Harry Potter\'s patronuses, which has only 1 characteristic - energy, it\'s tokens that are spent at high speed.</li>
<li>15) Cyberpsycho (controlled) - cannot control his body, remaining in it</li>
<li>16) Darwinian - can control the body, but with third-party commands on the neural interface</li>
<li>17) Invited - does not have his own body, is in someone else\'s, and his ability to influence him is determined by a number of factors</li>
<li>18) POS mining - keeping the imperative for tokens per second (or other profits depends on skills)</li>
<li>19) The implant of reality is the only conditionally physical object that describes all the organs at the same time, but is essentially an artifact</li>
<li>20) Advertising - broadcasting pre-loaded media on irritants (TVs, billboards, smartphone screens, etc.)</li>
<li>21) Psychotic, chaotic, toxins, spatial distortion - integrative graphic shaders</li>
<li>22) Flanger - a trail behind an object with a visual effect (depending on the context of skills)</li>
<li>23) Trace - iridescent line to the target</li>
<li>24) Avatar - an analogue of a statue that a character can move back into</li>
<li>25) Skills - opportunities, initially 2 cells, can be increased by taking one of the ability to evolve</li>
</ul>
<h2>Environment</h2>
<a name="2"></a>
<img src="/img/metaverse/realm.png" width="100%" style="float:right; max-width:300px; padding: 10px;" />
<ul>
<li>1) The temperature mechanics is that as the temperature rises, everything that drains HP starts to do it stronger, and at some point it is impossible to be on the realm due to overheating. When the temperature drops, the abilities start to work weaker until it just one-time kills everyone remaining on the realm. There are a lot of abilities that increase the temperature and only 1 that reduces it - Białe Zimno (140), or in common terms, burnout. Or when somebody leave realm, temp is deheating realm a bit.</li>
<li>2) Metaverse idea: Dodecahedron (12 side) planet with</li>
    <ul style="padding-left: 20px;">
      <li>a) North polar: Ancient Rome senate (primary imperative is expanding black hole that sounds like Дед ИВЦ (google it) and Goebbels combined, with the outlines of statues of various morphing people showing through and colors everything red in the zone of the accretion disk. (reffer to Stalker выжигатель мозгов))</li>
      <li>b) South polar: Olimp temple at the top of Everest (primary imperative is expanding black hole in the middle of sphere on Atlant\'s statue shoulders, and accretion disk is goldean aura with a mystic symbols and songs)</li>
      <li>c) North side 1: State institution square, with a buildeing the entrance to which looks like an ass hole, and the insides look like guts. The main imperative is room with a the red air conditioner on the facade</li>
      <li>d) North side 2: Graveyard</li>
      <li>e) North side 3: Swamp (like in Witcher 3, but with an old church in the middle) </li>
      <li>f) North side 4: Mental hospital of crypto startup</li>
      <li>g) North side 5: Maidan during the protests</li>
      <li>h) South side 1: Night Kathmandu</li>
      <li>i) South side 2: Toxic chemical plant</li>
      <li>j) South side 3: City like 千と千尋の神隠し movie</li>
      <li>k) South side 4: Neon nightcity like Cyberpunk 2077</li>
      <li>l) South side 5: Insulator in the aesthetics of Zen Buddhism</li>
  </ul>
<li>3) Universe will requery few realms with differnet spam/profitable level and allow bots like in TF2 but without rifle.</li>
<li>4) And will be perfect to make it DAO (bigest part opensource and voting blockchain for changes) and GPU minable (rendering equirectangular hell, calculating bot actions, generation custom realms).</li>
<li>5) It should work in webbrowser to simplify integration as smartphone devices (cardboard with 3 cameras looks well idea.. cloud rendering?)</li>
<li>6) The complete set of devices is seen as room side gyroscope/centrefuge device + bodypart controllers + vr headset. Compact MRT for reading neural pattern will be perfect too.</li>
<img src="/img/metaverse/station.jpg" width="100%" style="float:right; max-width:350px; padding: 10px;" />
</ul>

<h2>Skills</h2>
<a name="3"></a>
<ul>
<li>1) Guided projectiles of energy (like psyonic Elex 1)</li>
<li>2) Levitation (reffer to Control game)</li>
<li>3) Cyberpsycos (Taking control of a character with low HP for money per minute)</li>
<li>4) Hallucinations (reffer to Dead Space 1)</li>
<li>5) Phantoms (reffer to Dota, Phantom lancer)</li>
<li>6) Transition to dusk (reffer Ночной дозор movie)</li>
<li>7) Running attack (reffer to Dota Spirit Breaker)</li>
<li>8) Tunnel vision (reffer to Stalker controller)</li>
<li>9) Levicorpus like in HP (or like dart waider, need to do wommit test)</li>
<li>10) Psychedelic morph (like 3 days of 2-ci (200 mg))</li>
<li>11) Time sinusoid</li>
<li>12) Drainable wound</li>
<li>13) Voices in headphones</li>
<li>14) Toxicity (damaging aura)</li>
<li>15) Silencing (reffer to Trumps lawer)</li>
<li>16) Disarming</li>
<li>17) Licantropy (reffer to Ночной дозор movie)</li>
<li>18) Hypnos (slowing and blurring textures)</li>
<li>19) Metamorthism (taking on the form of another character)</li>
<li>20) Suicidal attack ( radial explosion - most expensive, reffer to Suicide Squad dota and religious fans)</li>
<li>21) Hyperstimulation (increase all physic, drain blast on use, reffer Star Craft marine)</li>
<li>22) Energy parasitism (aura stealing tokens)</li>
<li>23) Coeur de grace of a badly damaged character with a special effect</li>
<li>24) Sacrifice, exchanging hp of a victim of cyberpsychosis for money one-time</li>
<li>25) Darwinia. Access to the visual neural interface of another person</li>
<li>26) Voodoo. The ability to initiate cyberpsychosis in a Darwinist</li>
<li>27) Psycoterror. Energy traps on neurointerface</li>
<li>28) Psychomania. Ability to broadcast AOE energy traps at the cost of being able to move</li>
<li>29) Martingale. Damage absorption against tokens exponentially</li>
<li>30) Toxicomania. The ability to restore HP due to the imperative and all "stackholders"</li>
<li>31) Sai. Cumulative increase in efficiency of the energy imperative. Stackable</li>
<li>32) Flock. Cumulative increase abilities of hierarch</li>
<li>33) Self-torture. Increasing performance due to HP</li>
<li>34) Sadism. Passive regeneration in case of damage to anyone in the radius</li>
<li>35) Provocation. Inability to use skills on other targets until hit back (using any skill)</li>
<li>36) Torture. The ability to replenish HP for yourself and controlled units due to omniscience, incapacitating the character for a few seconds</li>
<li>37) Force field (warhammer chaplain), short-lived physical barrier in radius with sound and visual of church songs</li>
<li>38) Псина. The ability to increase the characteristics of controlled or Darwinians</li>
<li>39) Ritual. Requires the simultaneous participation of several characters and the victim. At the end, there is a stun in the radius</li>
<li>40) Psyker. Auravision through walls</li>
<li>41) Bloodseeker. The ability to trace the use of skills at a great distance in the form of a flanger to the target</li>
<li>42) Auroed. Increases the brightness and contrast of what is happening, everything else in the radius turns gray</li>
<li>43) Siren. Ability to generate deafening shockwaves</li>
<li>44) Desolator. The ability to generate white noise on all neurointerfaces within a radius</li>
<li>45) Psychiatrist. The ability to passively suppress the abilities of others radially</li>
<li>46) Leprechaun. Possibility of short teleportation (youtu.be/jjs2vPR19mQ)</li>
<li>47) Satisfaction. The ability to continue functioning with negative hp for some time until the last token</li>
<li>48) Tantra. The ability to transfer tokens to controlled and Darwinists at a distance</li>
<li>49) Reality shift. The ability to materialize random buildings or destroy them (Accompanied by a severest psychotic effect, similar to fire from white noise)</li>
<li>50) Psycholingam. The ability to broadcast to neural interfaces to other participants by a materialized object within a radius (even not required to summon, can be used any)</li>
<li>51) Biopsychosis. The ability to receive part of the hp spent by other players within the range of the summoned object</li>
<li>52) Warp rupture. Summons Cthulhu-like creatures (masked psycotics) with a short duration of existence in the form of energy entities</li>
<li>53) The door of measurements. The ability to change the realm to a random one after going through a warp gap while maintaining characteristics</li>
<li>54) Sh*tcoin. The ability to exchange your HP for blockchain at a rate based on a random value (but higher than 1)</li>
<li>55) Monopoly. Possibility to carry out a general annihilation of the realm by capturing all the imperatives</li>
<li>56) Arcanum. Renunciation of abilities at the expense of immunity to everything non-physical (alcoholism)</li>
<li>57) Void shield. Ability to convert non-physical damage into tokens for a short time depend on initial deposit. Tokens will be burned on start</li>
<li>58) Slave trade. The ability to cede the rights to control a cyberpsychic character for tokens</li>
<li>59) Chronoshift. Rewinds time on realm back for a short period. Second most expensive skill</li>
<li>60) TechnoTerraforming. The ability to change the landscape with tokens and microtech (neurointerface can be reffer to Perimetr game)</li>
<li>61) Knockout. Turns the body rig into a ragdoll for a few seconds, greatly darkening the view</li>
<li>62) Sadomasochism. The ability to increase tokens at the expense of HP and illumination for the entire realm</li>
<li>63) Botocontroller master. Extended neural interface features (reffer to Multiwinia)</li>
<li>64) Advertising. Ability to broadcast animation to psychoannoyer objects</li>
<li>65) Psychoresonance. The ability to broadcast your advertisement for a short time on all irritants, with a lower capitalization of the current exploiter</li>
<li>66) Breathtaker. Radial aura of toxicity on controlled psycho irritants</li>
<li>67) Visualizer. Capable of relaying animation from a psycho irritant the form of radial hallucinations</li>
<li>68) Sonic. Capable of relaying a visual signal to audio as noise in headphones similar to synesthesia</li>
<li>69) Undercut. The ability to purposely steal tokens upon direct contact with the character</li>
<li>70) Psychovampirism. The ability to switch to the view of the victim and her neural interface. Incapacitates the user and drains the target\'s HP in process</li>
<li>71) Contusion. Attack after which begin flashbacks sometimes</li>
<li>72) Perimeter. Ability to create an energy circuit that causes electric shock on contact</li>
<li>73) Theta rhythm. Speed up movement from special effects in the form of a long flanger behind (reffer to Bender 4d dance, Futurama)</li>
<li>74) Tagpunk. Ability to apply colored blobs and lines on textures up close</li>
<li>75) Consumer. The ability to increase abilities with each defeated opponent</li>
<li>76) Diplomat. The ability to transfer part of the effect or the whole effect to other person (depending on the specific mechanics and the number of side tokens)</li>
<li>77) Epsilon. The ability to intercept access to the Darwinian neural interface from a Darwinist with fewer tokens</li>
<li>78) Manipulator. Able to use the Darwinian neural interface with fewer tokens without intercepting access</li>
<li>79) Devotion. The ability to shield the interface from third-party Darwinists</li>
<li>80) Synapsis. The ability to suppress non-physical effects radially within range. Passively stacks</li>
<li>81) Psychotic. Ability to amplify non-physical effects within range. Passively stacks</li>
<li>82) Animal eating. Increased health pool, reduced movement speed and a weak flanger trace</li>
<li>83) Surrender. The ability to offer an attacker conscious cyberpsychosis themself in exchange for tokens</li>
<li>84) Psychoabsorption. Ability to gain HP and/or tokens through a functioning ad stimulus on contact</li>
<li>85) Psydominator. Passive ability to gain control of Cyberpsychotics and Darwinians on same smart contracts when killing a Darwinist</li>
<li>86) Repartition. Ability to offer the attacker compensation in the form of tokens due to immunity to his skills</li>
<li>87) Integrated circuits. Ability to de-energize all imperatives by controlling a single</li>
<li>88) Banshee. Radial sonic impact on headphones with visual distortions of the neural interface</li>
<li>89) Overload. Visual distortion and patterned voices in headphones. Effect stacks when crossed (resonant beating)</li>
<li>90) Evolution. The ability to develop additional skills at the expense of time, tokens and HP</li>
<li>91) Proof of eco. Changing the staking mechanism to relative when capturing more than 50% of the staking share, based on the intensity of hp consumption within the imperative\'s range</li>
<li>92) Hierarch. The ability to change the appearance and one of the skills of the controlled to your own</li>
<li>93) Virtual reality. The ability to immerse yourself and another character in an alternative sub-realm for a short period</li>
<li>95) https://www.youtube.com/watch?v=CLCy87zqMSQ</li>
<li>94) Legacy. Decreasing effectiveness of skills depending on the relative HP level of the enemy character</li>
<li>96) Dementra. Ability to be excluded from the realm of a character with very low HP and tokens for several minutes (direct transaction)</li>
<li>97) Demonization. The ability to powerup skills of a controlled character to annihilate another (the effect depends on the difference in capitalizations, reffer to Heroes 3 Pit Lord)</li>
<li>98) Censorship. The ability to block psycho irritant broadcasting radially due to tokens (with a higher capitalization than the broadcaster)</li>
<li>99) Corruption. The ability to share damage with controlled and Darwinians (based on relative capitalization). The skill passively destroys tokens every second a little and a lot on damage (reffer Warlock bounds Dota)</li>
<li>100) Status. The ability to passively steal tokens from controlled and Darwinians at the expense of HP</li>
<li>101) Toadying. The ability to increase the number of tokens with any energy parasitism</li>
<li>102) Masson. The ability radically increase the number of tokens with any energy parasitism at the cost of the ability to move and hallucinations. Activated Ability</li>
<li>103) Kiss bang bang (Compromising evidence). Ability to extract all HP and tokens from an immobilized character on phisical contact</li>
<li>104) Piñata. Possibility to give one of the controlled provication skill insteed other abilities</li>
<li>105) Arrest (US medicine). The ability to draw all the tokens upon physical contact with a character with low HP</li>
<li>106) Cyberbullying. The ability to stun the broadcaster upon physical contact with an irritant</li>
<li>107) Parity. Opportunity to conclude xp deals in exchange for tokens (at a bad exchange rate, below 1) and vice versa (also on unfavorable terms)</li>
<li>108) Backstab. The ability to approach the enemy at dusk (ability 5) and make a stunning attack</li>
<li>109) True sight. Passive ability to detect characters in the dusk (6) and distinguish between phantoms (5), primitive bots, hierarch\'s dolls (92) and the actual characters</li>
<li>110) Corporat. The ability to get not only tokens from controlled imperatives, but also hp from total enteropy ((entropy / number of corporats) - small differential)</li>
<li>111) Democrat. The ability to provoke conflicts between Darwinians in order to consume HP and tokens</li>
<li>112) Shepherd. Translates images of competitors to stimuli and the form of hallucinations radially</li>
<li>113) Attention whore. Passively capable of drain tokens a little if the irritants is at least in the distant field of view at the cost of vulnerability to non-physical impact</li>
<li>114) Multiple cast. Chance to deal multiple damage with skills if the enemy is weakened or has less than half HP (reffer to Dota Ogre Mage)</li>
<li>115) Pyrokinesis (burnout). The ability to channel from a short distance to destroy enemy tokens over time, causing little damage</li>
<li>116) Biokinesis (lifeleach). The ability to channelly drain the opponent\'s HP from a short distance, regenerating a little HP for yourself, but reducing their maximum value, and ending in a hunchbacked ghoul over time</li>
<li>117) Psychokinesis. The ability to channel the income and regeneration of the victim from imperatives, irritants and skills from a short distance</li>
<li>118) Exorcism. Ability to deal minor damage, stun, and knock back the victim to the ground with a psychotic energy blast on contact</li>
<li>119) Billionaire. The ability to illuminate oneself for the entire realm for a short time, while simultaneously broadcasting a signal to all neurointerfaces. Requires capitalization of tokens higher than 90% of the characters</li>
<li>120) Parishioner. The ability to consciously offer oneself as a subject for cyberpsychosis at an increased rate</li>
<li>121) Freelancer. Ability to knowingly offer yourself as a Darwinian at an increased rate</li>
<li>122) Puppeteer. The ability to tint the auras of the controlled and Darwinians in different colors to build squads</li>
<li>123) Illuminator. The ability to draw energy traces in the dusk (5)</li>
<li>124) Vampiral. Passive ability to increase the effectiveness of skills aimed at draining HP for all controlled, darwinians, puppets and pack members</li>
<li>125) Dehumidifier. The ability to increase the temperature due to the refusal of a share in the POS (the overall level of the intensity of the consumption of hp)</li>
<li>126) Alienation. Sacrifice by one of the controlled in order to increase the performance of all other controlled, Darwinians and puppets and passive overspending of HP in their favor (low intensity, like just blaming others)</li>
<li>127) Cavalier. The ability to highlight and increase the characteristics of one or more Darwinians at the cost of a small amount of HP for all participants</li>
<li>128) Christins. Moving the one of controlled player to a new body, another one of the controlled, disconnecting from the donor realm for several minutes</li>
<li>129) Ghoul. Ability to consume a fallen body to restore HP</li>
<li>130) Cadaverous poison. The ability to leave a cloud of toxicity after death, the intensity and radius of which is determined by the remaining tokens</li>
<li>131) Caustic. Ability to gain HP in cloud and toxicity aura, and able to consume even stinking bodies if Ghoul ability is present</li>
<li>132) Revolutionary. The ability to change actual skills at the expense of tokens (reffer to DotA Invoker)</li>
<li>133) Justice. Possibility to pull some tokens after taking damage</li>
<li>134) Partisan. The ability to blend in with the environment (texturally)</li>
<li>135) Overlighting. The ability to bring out of the twilight and highlight the partisans radially</li>
<li>136) Burer. The ability to short distance drag bodies to summoned objects to give them the ability to participate in POS as an imperative</li>
<li>137) Republican. The ability to broadcast a commercial offer to become a cyberpsycho or a Darwinian, within the radius of all irritants with a smaller capitalization upon contact with one of them</li>
<li>138) Psychoamorphy. Possibility of increased resistance to non-physical effects at the expense of reduced to physical ones</li>
<li>139) Hypertoxicity. The ability to explode corpses in the area of effect of the summoned object to increase the temperature (and add a toxic visual effect) of the realm</li>
<li>140) Białe Zimno. Freezes HP for yourself and others, reducing the temperature in the realm to the lowest possible</li>
<li>141) Prophecy. Opportunity to throw the remaining tokens at the expense of increased capitalization in the next realm game</li>
<li>142) Watermelon. Possibility to donate the remaining tokens towards the receipt of the imperative in access from the beginning of the game in the next game on the realm</li>
<li>143) Coronation. The ability to fall into cyberpsychosis in order to redistribute tokens upon death with a character</li>
<li>144) Coronavirus. The ability to give all controlled, Darwinians and dolls an analogue of the Sh*tcoin skill</li>
<li>145) Compromise. The ability to deal damage not to HP, but to tokens.</li>
<li>146) Existential parity. Opportunity to offer an all-in bet</li>
<li>147) VR development. The ability to open access to the sub-realm, leaving the body as an imperative</li>
<li>148) Spirit of fire. The ability to raise the temperature on a realm with an avatar in the form of an imperative</li>
<li>149) Multiplicator. Ability to turn an avatar into multiple energy entities controlled by bots</li>
<li>150) Screenwriter. The ability to drag everyone holding your avatar as an imperative into the sub-realm</li>
<li>151) Defiler. The ability to be forcefully drawn into a sub-realm through contact with an avatar</li>
<li>152) Collector. The ability to get permanent access to the realm when in contact with the avatar. Consumes almost all HP when used.</li>
<li>153) Admin. Ability to send the collector back without tokens</li>
<li>154) AI. The ability to borrow miner power to combine realms (something like Midjourney only in n-Dimension)</li>
<li>155) Spatial distortions. The ability to cause a local space collapse that pulls tokens in a radius</li>
<li>156) PsychoTweeter. The ability to summon a local black hole in the middle of the sub-realm through an avatar at a short distance</li>
<li>157) Sarin. Ability to increase temperature and create visual distortions in the sub-realm upon contact with an avatar</li>
<li>159) Multiversion. The ability to stay in several realms (subrealms, due to intelligent mixing of the render signal of the head game object)</li>
<li>160) Hidden DevMode. The ability to enter an avatar in dev mode, which will cause vomiting when trying to influence the sub-realm from outside, one of the toxic legacy mechanics</li>
<li>161) Entertainment. The ability to set a fee for the ability to move to the sub-realm in the form of hp, tokens, or the need to become a controlled, darwinian or doll</li>
<li>162) Psychodrainer. The ability to pay extra hp and tokens for someone to visit your sub-realm</li>
<li>163) Neuroleptic. The ability to temporarily turn off the signal of the neural interface and multiversion for tokens per second</li>
<li>164) Poisoner. Possibility to feed an avatar a neuroleptic upon contact with the risks of the ritual of war or one of the vomiting legacy mechanics with a duration relative to capitalization</li>
<li>165) Energy prosecution. Possibility of a powerful attack from the twilight on a character who has increased the temperature on the realm one-time. Passively gives heatmap vision</li>
<li>166) Betrayal. Ability to receive signal from different darwinists despite Devotion (79)</li>
<li>167) Spirit of lightning. Ability to blink short distances, with vfx electricity discharge. Consumes tokens that are radially in scope</li>
<li>168) Energy trap. The ability to set traps in the dusk, which are triggered by a number of skills used within the radius of action, drain tokens</li>
<li>169) Economic fascism. Ability to recalculate hp capturing all imperatives based on capitalization</li>
<li>170) Carousels. The ability to increase capitalization by moving between imperatives. Increases temperature</li>
<li>171) Radiation. The ability to put the imperative into overconsumption mode at the cost of firing alpha particles with increasing intensity</li>
<li>172) Perpetual motion machine. The ability to passively keep your total HP at one plateau while the temperature in the realm is ideal, while capturing more than 50% imperative influence</li>
<li>173) Conscious degradation. The ability to abandon the skill for tokens (the amount is random, but does not exceed the maximum capitalization)</li>
<li>174) Forced evolution. Allows you to expand the number of available skills by 1 at the cost of the entire realm losing 1 random skill when capturing all realm imperatives</li>
<li>175) Triplication. Ability to get 2 clones of bots, which are considered realm miners with a pay per second mode</li>
<li>176) Phase shift. Changes in the direction of gravity of the realm and its shape for a short time. The third most expensive skill (recalculation of the level of miners\' resources) when capturing more than 50% of imperatives</li>
<li>177) Boiler. Ability to drain tokens from all POS participants. Requires contact with the imperative and immersion in one of the sub-realms in the form of 50% multiverse</li>
<li>178) Chakram. A projectile in the form of a controlled disk that pulls towards itself upon contact with the head of character, if the capitalization is higher, if it is lower, then it repels</li>
<li>179) Riot. The ability to put a character in an animal-like state, increasing his physical skills, but depriving him of the ability to fully use non-physical skills for a limited time during physical contact. A red mark appears on the forehead of the violent and he\'s became visible for all enery prosecutors.</li>
<li>180) Pain merchant. Possibility to buy the consent of the characters to experience one or more Legacy mechanics than sell it or use.</li>
<li>181) Cali Bank client. The ability to offer other characters to buy their consent to test one or more legacy mechanics, but without the right to resell</li>
<li>182) Energy signature. The ability to apply a small luminous signature (one of several patterns) to the character\'s body, which is visible from the dusk and energy prosecutors</li>
<li>183) Thief. The ability to drain part of the tokens from controlled, darwinians and dolls when they die</li>
<li>184) Sale of assets. Possibility to sell the asset in parts, but not more than 4 parts</li>
<li>185) Implantation of reality. The ability to get night vision, thermal vision and dim vision with the ability to switch between them and normal mode</li>
<li>186) Rape. The possibility of a collective attack on the target, incapacitating it for a short time and twisting the tokens</li>
<li>187) Outcast. Radial token destruction aura</li>
<li>188) The splitting of personality. The ability to split into several animals with one random skill for each and control them through multiverse</li>
<li>189) Shiza. The ability to leave the body and place yourself in the character, partially controlling the motor skills and neural interface at the cost of all tokens at once. Works only with characters with a lower capitalization, otherwise it\'s just a suicide in favor of the character. If the body goes rotten or is eaten, then this means death for the infector</li>
<li>190) Balance. The ability to close the schizo process in oneself, completely depriving the infector of working channels</li>
<li>191) Spirit of water. Ability to move as a stream of invulnerable energy liquid for a short time</li>
<li>192) Chimera. The ability for multiple characters to merge into one body, with increased stats and several random skills</li>
<li>193) Warlock. Possibility to forcibly infuse a badly injured character for tokens per second</li>
<li>194) Obscuria. The ability to make fast movements in the form of chaotic materia, draining HP in the area of effect and causing spatial distortions</li>
<li>195) Main frame. The ability to instantly go to the most profitable and competitive realm</li>
<li>196) Storm spirit. The ability to summon a storm vortex around you with energy entities circulating through it</li>
<li>197) Bile. The ability to cover everything around him with a radially black, sticky and dirty substance.</li>
<li>198) Drug huckster . The ability to draw web lines in the dusk, upon contact with which indicators temporarily increase, but hp and tokens begin to drain. If no one has fallen into the web for a long time, it begins to drain the huckster himself</li>
<li>199) Lich. Possibility to plant a leech to person on direct contact, which drains HP over time in favor of the infector. In infrared and dusk, traces to the infector become visible. You can stop the process by destroying the enemy or sending him to another realm</li>
<li>200) Creditor. He\'s like a lich, but drains tokens</li>
<li>201) Prostitute. The ability to create and control a phantom, upon contact with which there is a serious consumption of hp and tokens. There is a trace between the phantom and its owners, visible in the dusk and infrared spectrum.</li>
<li>202) Priestess. Ability to put a prostitute into cyberpsychosis upon contact with her phantom</li>
<li>203) Мент. Possibility of drain of HP and tokens from the phantoms of prostitutes, being in a drug dealers web, from the energy traces of the illuminates and energy traps on contact</li>
<li>204) Necrophilia. Possibility to fuck a corpse by inducing vomit (one of the legacy mechanics) if the character is still in the body</li>
<li>205) Necromancer. The ability to raise a corpse if the character is still in the body as a controlled. Consumes HP and tokens when used. Passively highlights inhabited corpses</li>
<li>206) Ghost master. The ability to turn a habitable corpse into an energy entity that will drain HP in favor of the master until he runs out of tokens, or he exorcises the ghost (requires contact)</li>
<li>207) Resuscitation. The ability to return to service the inhabited corpse of your controlled, darwinian or doll at the cost of a large amount of hp and tokens</li>
<li>209) Zнак отличия. The ability to apply a signature to the body of a controlled, darwinist, or doll to hide the rest and facilitate psionistic navigation</li>
<li>210) Marauder. Ability to drain most of tokens from an inhabited corpse on contact</li>
<li>211) Voodoo doll. The ability to damage yourself by doing the same damage to your controller, darwinist, or hierarch</li>
<li>212) Microloan. Possibility to lend tokens to others at 0.1-1% per second, paying only interest, while the character\'s balance is positive, otherwise a one-time payment of hp at the market rate</li>
<li>213) Psychotherapist. The ability to remove some psycho-effects from characters for tokens (arachnophobia, rampage, leech of a lich or creditor, contusion, etc.)</li>
<li>214) Russian roulette. The ability to play for all hp and tokens with a lich or creditor when contacting (without consent), or with a character with a lower capitalization with consent</li>
<li>215) Polymorph. The ability to turn a character with low hp and no tokens into a ram for a while</li>
<li>216) Psychomemetic. The ability to initiate a similar non-physical effect on the attacker (intensity level depends on relative capitalization)</li>
<li>217) Colosseum. The ability to move to the most profitable/competitive realm as an invulnerable energy entity with per-second payment and a built-in ability to levitate</li>
<li>218) 1xBET. The ability to bet on the capture of imperatives by characters, duels or the total share in the character\'s settlement after some time with other energy entities</li>
<li>219) Group levitation. Possibility to activate the levitation skill for the controlled, Darwinians and puppets with payment per second</li>
<li>220) Energy ball. Summons an energy sphere, which is controlled through a neural interface, which is available to all characters for control. The sphere moves slowly and, upon contact with the character, works like an explosion of ball lightning</li>
<li>221) Mortal Combat. Summoning an energy sphere, similar to an energy ball, only upon contact with the character works similarly to the Warlock ability, with relocation to the character with the highest capitalization</li>
<li>222) Nanotechnology. The ability to increase for tokens a share of the capacity of graphical mining realm, to improve the efficiency of all hardware processes</li>
<li>223) Quasar. Summons an energy sphere similar to an energy ball, only which can be launched into a spatial rift in order to summon a large number of energy entities in the rift on a randon realm, or into a character to annihilate it.</li>
<li>224) Psycoball. Summons an energy sphere, similar to an energy ball, only which can be launched into a spatial rift, so that everyone involved in management can go to a random realm, or into a character to initiate one of the legacy mechanics. A huge number of tokens are required to create and manage</li>
<li>225) Atomic energy. Ability to move radially around an imperative to slightly increase your POS share of that particular imperative</li>
<li>226) Nuclear reactor. The ability to use atomic energy not to increase the share in the POS, but to accumulate a static charge that works like a fireball explosion when it is no longer supported</li>
<li>227) Warp capture. The ability to summon a character from a random realm with payment in tokens per second, if you organize a rotation between 3 different imperatives in all available ways. Destroys all tokens radially on all 3 imperatives</li>
<li>228) Weirdmageddon. The ability to initiate a massive schizo process, capturing all imperatives. All characters that do not participate in staking are moved to those participating in the amount of 1 to n, where depending on the capitalization of the staking participant. Then each participant begins to pay every second to all the resettled tokens (like Warlock)</li>
<li>229) Soulorder. The ability to trade transmigrated characters for xp and (or) tokens with other bodily characters</li>
<li>230) Bioportal. The ability to temporarily become an imperative with the ability to appear on the realm for other characters from the lobby for tokens</li>
<li>231) Matriarch. The ability to endow your imperative with exceptional properties to appear on the realm if the total atomic energy output of the imperative exceeds all the others combined</li>
<li>232) Autopsy. The ability to extract a reality implant (185) from a corpse if it was there and insert it for yourself (cheaper than a new one) or resell</li>
<li>233) Telekinesis. Ability to throw one or more physical objects (reffer to Control game)</li>
<li>234) Patriarch. Ability to de-energize all imperatives except 1 when capturing all imperatives. The situation continues while the patriarch is on the realm, perhaps even as an imperative if there are characters around him performing the stacking function (are in radius)</li>
<li>235) Spontaneous combustion. The ability to commit suicide at the cost of a large number of tokens, leaving behind a portal that radially drian the tokens while active and leads to another realm, similar to the Warp gap (52). Tokens goes to the character\'s account while he is in a stationary gap object on the realm</li>
<li>236) Interdimensional orientation. The ability to consciously choose a target to move, use a list of AI recommendations, rely on random from procedural generation or random from existing active realms</li>
<li>237) Collective meditation. The ability to influence the procedural generation of the realm through the neural interface of all participants in the psychoball (224)</li>
<li>238) Worst practice. Ability to get individual access to dead realms in free-look-mode and access to realm timeline management</li>
<li>239) Fork of history. The possibility at any moment of the dead realm to be embodied in an exact copy of the realm at the cost of all tokens with the replacement of characters with bots (as long as the capitalization is enough)</li>
<li>240) Bet. The ability to bet with other ghosts of free-look-mode dead worlds for tokens who will be able to keep the realm alive longer from the same starting point for everyone</li>
<li>241) Qi Flash. Possibility for tokens to broadcast in the lobby an invitation to join the target realm for a reward commensurate with the time spent (but not more than the threshold)</li>
<li>242) Sabotage. Possibility to withdraw for some time imperative from POS distribution on contact</li>
<li>243) Stasis. The ability to turn the body into a fossil in order to go offline and return back to the realm. Only available outside the range of imperatives and irritants, and vulnerable to a number of abilities. Consumes tokens per minute</li>
<li>244) Sea of poison. The ability to capture all imperatives to initiate a biblical flood of caustic toxins that will fill the map until it destroys 90% of the inhabitants</li>
<li>245) Spirit of bile. The ability to turn into a shapeless stream of bile that mixes at high speed and leaves a sticky trail behind it (197)</li>
<li>246) Anthrax. The ability to infect a character from a short distance. Infection twists HP in favor of the original Infector, and is transmitted through contact. The effect wears off after a while</li>
<li>247) Businessman. The ability to turn bile into tokens, drainig them or the equivalent of hp from the source of pollution until it is completely depleted while it is on the realm, then at the total expense</li>
<li>248) Spirit of chaos. Possibility in the force of pure chaos to make several random movements in the realm, draining HP and causing spatial distortions (uncontrollable and chaotically teleporting abscuria (194))</li>
<li>249) Lord of mental pain. Passive ability to radially drain some tokens from anyone who uses non-physical skills in close range</li>
<li>250) Jailer. The ability to chain a stacking character to an imperative with an energy chain, thereby slightly increasing of the imperative share of the total stacking</li>
<li>251) Master of enslavement. The ability to chain controlled, Darwinists or puppets to yourself with an energy chain to limit their movement range at the expense of a small per-second token payment</li>
<li>252) Homunculus. The ability to shock chained characters, which will give a bolt of lightning if used in the context of an imperative, or a temporary stat boost if on yourself. Temporarily reduces stats and HP of bounded, which are gradually replenished</li>
<li>253) Local network. Ability to create local chats within realms. To create a network, contact with the psycho irritants is needed, for its functioning - the control of at least one irritant</li>
<li>254) Brahman. The ability to open a pagan bioportal if you make contact on equal terms with 3 more characters with this skill. Maintaining the bioportal requires tokens per second and immobility, and both characters and energy entities generated by quasars can come through it (223). But you can quickly turn off, unlike the bioportal skill (230)</li>
<li>255) Drain fat. The ability to butcher a corpse, resulting in a fat candle that can be lit at any time to provide a small radial regeneration for a short time. Candles do not disappear after death and can be extracted from the corpse with the skills Marauder (210) and Autopsy (232)</li>
<li>256) Mosquitoes. The ability to fire multiple guided projectiles that drains a bit of HP on contact. Can be made from the dusk without breaking the disguise</li>
<li>257) NFT trading. Possibility in the Worst practice (238) mode to participate in trading and auctions for dead realms. In the case of someone using a realm for betting (240), the opportunity to receive tokens for this</li>
<li>258) Shackles. The ability to slow down the character a little at a short distance using the energy lasso. Effect stacks</li>
<li>259) Куплинов Play. Ability to create flashes of Qi (241), inviting for tokens per minute to move into his body on the realm (193)</li>
<li>260) SEO. The ability to link between imperatives and irritants to increase efficiency. Links are an energy network cables in the dusk, which disappears when control over the object is lost</li>
<li>261) Starfall. The ability to add additional tokens from a colored wallet to a realm smart contract, but they will come in the form of a multi-colored energy starfall in a radius from the character, with an efficiency below 1</li>
<li>262) Jockey. The ability to ride an energy entity for the period of its short existence</li>
<li>263) 3,14 Brontohash. The ability to submit a hashing task with a high priority to miners in order to greatly reduce hardware performance and weaken realm bots</li>
<li>264) Isolation. Possibility to exclude imperatives or irritants by laying a shielding contour in the dusk around at least 2 objects. Erased over time</li>
<li>265) Go 16x16. The ability to play Go on the neural interface to intercept the irritant</li>
<li>266) One-armed bandit. The ability to play for tokens in slots (casino) on someone else\'s irritants with direct contact</li>
<li>267) VRWeb. Ability to open a frame with a browser window on the neural interface leading to the general chat of the realm (configurable) </li>
<li>268) Pain centers. The ability to create and maintain a radial energy vortex that drains HP if the affected character does not use skills for a short period of time</li>
<li>269) Brain waves. The ability to copy one random skill from a character within some range for tokens. Efficiency and cost of use is increased, and the duration of action is limited</li>
<li>270) Sale of the soul. The ability to sell relocation to the body of another character after death with a minimum stay timeframe in it for tokens that will go to the color wallet after the specified period (if there was no disconnect, and moneyback on disconnect)</li>
<li>271) Belostotsky. The ability to exchange physical position with one of the controlled during the attack.</li>
<li>272) Energy president. A character that initiated a pull-request in a realm\'s DAO that was successfully voted to be included in mechanics, models, scenarios, realms, or data generation scripts. Gets seamless ability to fully navigate through all realms as an energy entity (until the next embedded pull-request)</li>
<li>273) Ikarus. Possibility to initiate Levitation (2) ability to character on contact, which (depending on the number of charged tokens) will be finished after some time and character lands taking damage proportional to the height. Being on the surface begins to spend tokens little by little.</li>
<li>274) Invoker. The ability to summon 3 energy spheres that begin to levitate around and are available for attack through the neural interface or as a physical object</li>
<li>275) Abhi. The ability to briefly create a small force field, the size of the palm of your hand, which can block the damage of physical attacks</li>
<li>276) Jin. The ability to sacrifice one of the incorporeal characters invited to the body instead of taking damage</li>
<li>277) Patronus. The ability to release one of the invited characters from your body as an energy entity for a short time</li>
<li>278) Energy Glyph. The ability to draw and send a glowing glyph as a projectile, which will be displayed on the interface and give a micro-stun (knocks channel abilities)</li>
<li>279) Mediasphere. Ability to materialize energy spheres from controlled stimuli similar to those of Invoker (274)</li>
<li>280) World broadcast. The ability to start broadcasting your video processed by a neural network instead of the default equirectangular sky when capturing more than 50% irritants</li>
<li>281) Wyrm. The ability to release a controlled energy entity that moves forward and shows on the neural interface all the anomalies of the dusk (energy traps, illuminator traces, link cables, hiding  characters, etc.) that it detects radially in front of itself</li>
<li>282) Imperative control. Possibility when capturing all imperatives to move to yourself with payment in tokens per second</li>
<li>283) Political satanism. The ability to mix controlled, Darwinians and puppets into different bodies in a chaotic manner, with a radial stun and a temperature increase in the realm</li>
<li>284) Verbal diarrhea. The ability to broadcast through the irritants to the headphones the schizophasia generated by the speech synthesizer based on the keys that the neural network saw on the broadcast animation, which stuns a little radially</li>
<li>285) Dialogue. The ability to invite a character to one of the random dead realms for dialogue in the form of energy entities until one of the parties admits they were wrong or simply finds further conversation inappropriate. With consensus and before transitions to the philosophical sub-realm, the rate is set in the form of tokens</li>
<li>286) Dual currency policy. The ability to trade tokens of another realm, at a self-set rate (via a deposit to the colored wallet of the realm of tokens)</li>
<li>287) Cloud torrents. The ability to receive a share from auctions, disputes and trading of dead realms by storing and distributing NFT realms via torrents (from your PC)</li>
<li>288) Conjugation of spheres. The ability to clone an existing realm, moving half of the characters of the existing realm into it and leaving a gap in both Warp realms when capturing more than 50% of the imperatives</li>
<li>89) El laberinto del fauno. The ability to intercept the stimulus by solving the generated puzzle maze, the complexity of which depends on the relative capitalization</li>
<li>290) Universum. The ability to initiate the generation of realms for tokens at the expense of the rented capacities of miners, with the subsequent ability to access them from the lobby</li>
<li>291) Dusk navigation. The ability to build a map of explored energy objects in the dusk with a display on the your neural interface or as a hallucination for a third-party character (the entire map, its parts or individual objects as a frame from a historical render)</li>
<li>292) Psychostrike. The ability to combine the abilities of Invoker (274) and Warlock (193), namely not only to launch a physical object along different trajectories, but also to pre-place one of the invited characters in the projectile, followed by annihilation of it and an additional blow to enemy tokens</li>
<li>293) Sonic Wargun. The ability to stun and knock to the ground for a couple of seconds at the cost of your own HP and tokens, causing significant HP damage to the character and everyone connected with him (251) from a short distance</li>
<li>294) Trimurti. The ability, in addition to the Invoker skill (274), to use the spheres not only as projectiles, but also to form a triangle (connecting the spheres with energy threads), hitting which the character is teleported to a random part of the map with the loss of tokens. At the same time, each area is still managed separately.</li>
<li>295) Primal broth. The ability to initiate a recalculation of the buff / weaken coefficients of the abilities of controlled, Darwinians and puppets (based on relative capitalization). Odds extremes are determined by the number of used tokens, but not more than 1.5</li>
<li>296) Ecologist. Passive ability to regenerate hp when the temperature in realm is ideal, and otherwise hp are losing during time</li>
<li>297) Imba. The ability to write off very few tokens from the character with the largest number of tokens in the realm. The amount depends on the difference in capitalizations (the higher it is, the more tokens the ability writes off)</li>
<li>298) Necromorph. The ability to infuse into an uninhabited corpse of one of the invitees into your body. The raised body has the skills of the fallen one, without the possibility of development and the gradual consumption of hp. Requires HP and tokens to use</li>
<li>299) Дяды. The ability to radially, after a long preparation, enable the inhabitants of the corpses to become an energy entity for the remainder of the tokens per second</li>
<li>300) Insider. Ability to redistribute Sh*tcoin (54) relative value coefficients for controlled characters, darwinians and dolls, as well as ability to relay information from controlled characters’ irritants to master irritants</li>
<li>301) Trojan xling. The ability to install a Trojan on an imperative or irritant, which, when captured, spreads to other controlled imperatives and begins to gradually twist tokens in the background in favor of the infector. The Infector takes damage when using integrated circuits, atomic energy (reactor) or another trojan on the imperative</li>
<li>302) Cyberdemon. The ability to highlight the Infector and the energy trail before it upon contact with the Infected Imperative or irritant</li>
<li>303) IT audit. The ability to remotely access the neural interface (darwinia) of the infector through a controlled irritant or imperative</li>
<li>304) Dev Fees. Passive ability to receive tokens from a Trojan to a colored wallet even after leaving the realm (with a bruteforce risks)</li>
<li>305) SSH brute force. Possibility to steal 50% of the infector’s tokens after some time (depends on the relative share in the POS of the parties) of the channel contract interaction with the imperative</li>
<li>306) Iframe exploit. The ability to broadcast your animation on the irritants of the infector during channel contact interaction with the infected irritant</li>
<li>307) Netrunner. The ability to access the neural interface of everyone who participates in POS with your trojan imperative infected</li>
<li>308) Short circuit. Possibility to deal minor damage to the Infector (301) of an Imperative or irritant. Deals high damage if Reality Implant is placed (185)</li>
<li>309) Firewall. Possibility to install a firewall at the cost of a share in the POS or reduce the range of the irritant, which crashes when the imperative or irritant is recaptured</li>
<li>310) Cybertoxic. Ability to initiate an radiaul aura of toxicity (14) on infected irritants or imperatives</li>
<li>311) Neurosynchronization. The ability to introduce an infector with a reality implant to cyberpsychosis or during a brute-force of your colored wallet</li>
<li>312) Shadowrun. Ability to psionically see imperatives, irritants and links (260) at dusk (6) through walls</li>
<li>313) Copyrights. Possibility for tokens to resell the control of irritants or the rights to the wallet of a Trojan that is set to an imperative or an irritant (included risks)</li>
<li>314) Ловите наркомана! The ability to drain some tokens from a character levitating nearby</li>
<li>315) Kunstkammer. The ability to set exceptional rules when initiating the generation of realms with the abilities of the Universe (290), collective meditation (237) and interdimensional orientation (236) - token thresholds, evolution level, forbidden skills, etc.</li>
<li>316) Programming patterns. Ability to draw simple flowcharts for darwinians (if, else, for, while, goto)</li>
<li>317) Hypersensitivity. Possibility to feel the presence radially (the intensity of the graphic signal depends on the distance to the object and its nature - character, imperative, irritant, energy entity, corpse, fallen character, spatial gap</li>
<li>318) Tron. The ability to increase movement speed, leaving behind a flanger, contact with which will stun a third-party character with a stun</li>
<li>319) Discobolus. The ability to materialize and throw a disc that ricochets off surfaces and can be pulled back telekinetically. Deals HP damage and stuns on hit.</li>
<li>320) Cyberpunk. The ability to enroll one of those invited into the body on reality implants so that when trying to reimplant it, burn all the recipient\'s HP and tokens (if there are fewer tokens) or seize control of the body (if there are more tokens). The perception of reality outside the body (on the chip only) becomes like white noise with waves based on the temperature patterns of space.</li>
<li>321) Blockchain node. The ability to transfer some tokens from the balance to a colored wallet through an irritant upon contact in order to protect them from most of the attacking skills of third-party characters</li>
<li>322) Mantra. The ability to broadcast a signal through an irritants that increases the performance of controlled, darwinians and dolls, as well as gradually reduces the maximum HP threshold for everyone within the radius of action. Threshold hp very slowly recovers outside zone of the irritant)</li>
<li>323) Vipassana. The ability to passively regenerate HP if the character does not use skills for a long time</li>
<li>324) Shelogram. An ability similar to cyberpunk, only a digital copy of your consciousness is recorded on the implant. After use, artifacts begin on the interface and vision, the intensity of which depends on the level of HP</li>
<li>325) Biological tax. The ability to initiate an HP drain while use of the Bioportal or Brahman skill to one\'s advantage. Low intensity, but consumes all the HP that was assigned when entering the realm, after that it stops</li>
<li>326) Banderas. The ability to illuminate several characters in an area with a visibly psionistic aura and stun a little for a short time</li>
<li>327) Operation "Ы". The ability to project the space of another realm with a radius of action onto the current realm, the process is accompanied by chaos and spatial distortions</li>
<li>328) Tour de marc. The ability to raise the point of perception of the character\'s head up for a few seconds with equal acceleration and then return to its original state, while the body turns into a ragdoll</li>
<li>329) Beastmaster. Ability to gain control of morphed lycanthropes with fewer tokens on contact</li>
<li>330) Хозяин леса. The ability to take control of animals (188) from a short distance (and fewer tokens for a splintered character) at the cost of splintering one\'s own perception</li>
<li>331) Force screen. The ability to maintain a force shield with 2 hands in front of you, which blocks physical attacks and ricochets non-physical ones. Severely reduces movement speed (reffer monks in Doctor Strange movie)</li>
<li>332) Atoms of consciousness. The ability to launch an unguided projectile of spheres, which (if it does not encounter a physical obstacle) splits into 2 of the same spheres every 2 seconds. The fission process continues at least 10 times if there is at least 1 active projectile. The sphere deals low damage, and has an area of effect that is half the size of the realm. Upon contact with the sphere, the character will receive damage commensurate with the number of spheres at the moment (the fewer spheres, the more damage). Reference to Дневной дозор movie</li>
<li>333) Flugergehaimer. Ability to send a character without tokens to the most competitive realm upon contact</li>
<li>334) Orbital bombardment. The ability to deliver a massive impact damage to hp of every persons affected on the area at a distance at the cost of all the tokens from the colored wallet. Have a delay, and damage increased per time</li>
<li>335) Bear market. Ability to sacrifice tokens from color wallet to allow realm generate x2 public tokens for sale to reduce token market price (and increase realms direct capitalization).</li>
<li>336) Nirvana. The ability to leave the realm at any time while saving the remaining tokens to a colored wallet.</li>
</ul>
<h2>Project Scope</h2>
<a name="4"></a>
<p><a target="_blank" href="https://github.com/restinpc/Metaverse">Metaverse VR repository</a></p>
<p><a target="_blank" href="https://github.com/restinpc/Metaverse-build">Metaverse VR demo version</a> </p>
<br/>
<br/>';
}
