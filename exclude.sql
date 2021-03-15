-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : sqlgold.phpnet.org:48846
-- Généré le :  mer. 20 juin 2018 à 16:22
-- Version du serveur :  10.0.34-MariaDB-1~jessie
-- Version de PHP :  5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sql8846_1`
--

-- --------------------------------------------------------

--
-- Structure de la table `llx_EAN_exclude`
--

CREATE TABLE `llx_EAN_exclude` (
  `rowid` int(11) NOT NULL,
  `fk_ean` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `llx_EAN_exclude`
--

INSERT INTO `llx_EAN_exclude` (`rowid`, `fk_ean`) VALUES
(345, '0000040052397'),
(346, '0000772164177'),
(347, '0000772167024'),
(348, '0002084001645'),
(349, '0026635083423'),
(350, '0026635105767'),
(351, '0026635181792'),
(352, '0027084521375'),
(353, '0027084966220'),
(354, '0027084966299'),
(355, '0028178003050'),
(356, '0028178034313'),
(357, '0028178280895'),
(358, '0039897065045'),
(359, '0048419413240'),
(360, '0048419655770'),
(361, '0065541068117'),
(362, '0071662132828'),
(363, '0073854008072'),
(364, '0074427842765'),
(365, '0074427848477'),
(366, '0078257555048'),
(367, '0080518137382'),
(368, '0080518137429'),
(369, '0082686099226'),
(370, '0088168106048'),
(371, '0090159150558'),
(372, '0093577422535'),
(373, '0093577480139'),
(374, '0093577572834'),
(375, '0115433564552'),
(376, '0115439001150'),
(377, '0539411604946'),
(378, '0539411605554'),
(379, '0614239028041'),
(380, '0638097022164'),
(381, '0673419235631'),
(382, '0677726401000'),
(383, '0677726603466'),
(384, '0688623310005'),
(385, '0711719267454'),
(386, '0746775022013'),
(387, '0746775072834'),
(388, '0746775176150'),
(389, '0746775193430'),
(390, '0746775193546'),
(391, '0746775211509'),
(392, '0746775216955'),
(393, '0746775234553'),
(394, '0746775245931'),
(395, '0746775289775'),
(396, '0746775302955'),
(397, '0746775316303'),
(398, '0746775346492'),
(399, '0746775361655'),
(400, '0778988003589'),
(401, '0778988019016'),
(402, '0778988057247'),
(403, '0778988064429'),
(404, '0778988066379'),
(405, '0778988090978'),
(406, '0778988122860'),
(407, '0778988123713'),
(408, '0778988129494'),
(409, '0778988192528'),
(410, '0778988198650'),
(411, '0778988214992'),
(412, '0778988222034'),
(413, '0778988617601'),
(414, '0778988628799'),
(415, '0778988635667'),
(416, '0778988647332'),
(417, '0778988657928'),
(418, '0778988659274'),
(419, '0778988669372'),
(420, '0778988804957'),
(421, '0778988871270'),
(422, '0778988880456'),
(423, '0778988880500'),
(424, '0778988918722'),
(425, '0796714270234'),
(426, '0837654603970'),
(427, '0845423006860'),
(428, '0845423008765'),
(429, '0872354008434'),
(430, '0883028141234'),
(431, '0883028186853'),
(432, '0883028205523'),
(433, '0883028205530'),
(434, '0886747057350'),
(435, '0886747057381'),
(436, '0886747057411'),
(437, '0886747057688'),
(438, '0887961019025'),
(439, '0887961046267'),
(440, '0887961052893'),
(441, '0887961060805'),
(442, '0887961069785'),
(443, '0887961104066'),
(444, '0887961111156'),
(445, '0887961240535'),
(446, '0887961287233'),
(447, '0887961323580'),
(448, '0887961366532'),
(449, '0887961372700'),
(450, '0887961407129'),
(451, '0887961408188'),
(452, '0887961423556'),
(453, '0887961533392'),
(454, '0887961533514'),
(455, '2001801322351'),
(456, '2001941524844'),
(457, '2004630000018'),
(458, '3013648082731'),
(459, '3016200302018'),
(460, '3021105053385'),
(461, '3021105053620'),
(462, '3028760411529'),
(463, '3028760414711'),
(464, '3032160100419'),
(465, '3032160280777'),
(466, '3032161106045'),
(467, '3032161404103'),
(468, '3032162203255'),
(469, '3032162510506'),
(470, '3032163101536'),
(471, '3032163111009'),
(472, '3032163502074'),
(473, '3032164201006'),
(474, '3032167501059'),
(475, '3032167501301'),
(476, '3032167501424'),
(477, '3032167501523'),
(478, '3032167503435'),
(479, '3032167503459'),
(480, '3045670005884'),
(481, '3048700001672'),
(482, '3056562302004'),
(483, '3070900072060'),
(484, '3070900072152'),
(485, '3070900072411'),
(486, '3070900086302'),
(487, '3070900086487'),
(488, '3070900088818'),
(489, '3070900089402'),
(490, '3070900094925'),
(491, '3070900095106'),
(492, '3070900097230'),
(493, '3070900097575'),
(494, '3070900097926'),
(495, '3086123249233'),
(496, '3086124001700'),
(497, '3103220030417'),
(498, '3114524024347'),
(499, '3114524044321'),
(500, '3114524046806'),
(501, '3120720004410'),
(502, '3134729132500'),
(503, '3148950015259'),
(504, '3148950015266'),
(505, '3148950015303'),
(506, '3148957670017'),
(507, '3155287824300'),
(508, '3181860105337'),
(509, '3181860117972'),
(510, '3181860120606'),
(511, '3181860178461'),
(512, '3181860230503'),
(513, '3181860234372'),
(514, '3181860750421'),
(515, '3219030001896'),
(516, '3225280801209'),
(517, '3225430001107'),
(518, '3225430001510'),
(519, '3225430002197'),
(520, '3225430002203'),
(521, '3225430002272'),
(522, '3225430006119'),
(523, '3225430012226'),
(524, '3225430043992'),
(525, '3225435007081'),
(526, '3254775553002'),
(527, '3262190001060'),
(528, '3266792167698'),
(529, '3279510090642'),
(530, '3279510090963'),
(531, '3279510098501'),
(532, '3279663008297'),
(533, '3280250006404'),
(534, '3280250009917'),
(535, '3280250024743'),
(536, '3280250028635'),
(537, '3281640243515'),
(538, '3281640280572'),
(539, '3286413034215'),
(540, '3296580120352'),
(541, '3296580359202'),
(542, '3296580360208'),
(543, '3296580397457'),
(544, '3296580425556'),
(545, '3296580425600'),
(546, '3296580432004'),
(547, '3296580496013'),
(548, '3296580749300'),
(549, '3296580749331'),
(550, '3296580752799'),
(551, '3296580840304'),
(552, '3296580857654'),
(553, '3298060227957'),
(554, '3298060406390'),
(555, '3301040330285'),
(556, '3301040407833'),
(557, '3301040558030'),
(558, '3301046030134'),
(559, '3373910006781'),
(560, '3373910006927'),
(561, '3373910008884'),
(562, '3373910060059'),
(563, '3373910088053'),
(564, '3375701907574'),
(565, '3375702015049'),
(566, '3375702048924'),
(567, '3380743029788'),
(568, '3380743050867'),
(569, '3380743053332'),
(570, '3380743062884'),
(571, '3395400101592'),
(572, '3410442000402'),
(573, '3410443000302'),
(574, '3410443000357'),
(575, '3410560049338'),
(576, '3417761688052'),
(577, '3417761792056'),
(578, '3417762024552'),
(579, '3417762172451'),
(580, '3417762431053'),
(581, '3417768930659'),
(582, '3421271400226'),
(583, '3421271401551'),
(584, '3421272106813'),
(585, '3421272106912'),
(586, '3421272109517'),
(587, '3421272114214'),
(588, '3437011800010'),
(589, '3438617927491'),
(590, '3438617927514'),
(591, '3465000389758'),
(592, '3465000392413'),
(593, '3465000393885'),
(594, '3465000393892'),
(595, '3465000701048'),
(596, '3467452006368'),
(597, '3467452042571'),
(598, '3467452044988'),
(599, '3471052844541'),
(600, '3502250444964'),
(601, '3517132223506'),
(602, '3517133006825'),
(603, '3551093116415'),
(604, '3551093116446'),
(605, '3555801358029'),
(606, '3555801358036'),
(607, '3555801370014'),
(608, '3555801370038'),
(609, '3555801385025'),
(610, '3555801450051'),
(611, '3555804012201'),
(612, '3555808500025'),
(613, '3558380011811'),
(614, '3558380013327'),
(615, '3558380018797'),
(616, '3558380019190'),
(617, '3558380022152'),
(618, '3558380025894'),
(619, '3558380027119'),
(620, '3558380027447'),
(621, '3558380030607'),
(622, '3558380031772'),
(623, '3558380031987'),
(624, '3558380032557'),
(625, '3558380032618'),
(626, '3558380034162'),
(627, '3558380035374'),
(628, '3558380036166'),
(629, '3558380037781'),
(630, '3558380040309'),
(631, '3558380043676'),
(632, '3558380047476'),
(633, '3561863332259'),
(634, '3588270012093'),
(635, '3588270022696'),
(636, '3588270029909'),
(637, '3588270031490'),
(638, '3588270033128'),
(639, '3588270042182'),
(640, '3681643200292'),
(641, '3700010401770'),
(642, '3700010410246'),
(643, '3700010410260'),
(644, '3700010419256'),
(645, '3700126906183'),
(646, '3700143943017'),
(647, '3700143944052'),
(648, '3700217329891'),
(649, '3700217331047'),
(650, '3700217345532'),
(651, '3700217355432'),
(652, '3700217364816'),
(653, '3700217364854'),
(654, '3700217364939'),
(655, '3700217385149'),
(656, '3700217385156'),
(657, '3700217385170'),
(658, '3700224620318'),
(659, '3700320015001'),
(660, '3700320061299'),
(661, '3700320062425'),
(662, '3700325002419'),
(663, '3700335214383'),
(664, '3700335227994'),
(665, '3700349323323'),
(666, '3700349326553'),
(667, '3700460840235'),
(668, '3700514301026'),
(669, '3700514304270'),
(670, '3700514304355'),
(671, '3700514306366'),
(672, '3700514308568'),
(673, '3700514308773'),
(674, '3700514312503'),
(675, '3700815390590'),
(676, '3700855900780'),
(677, '3700994301660'),
(678, '3760039970213'),
(679, '3760039972125'),
(680, '3760046780874'),
(681, '3760046781130'),
(682, '3760049596397'),
(683, '3760052141904'),
(684, '3760052141997'),
(685, '3760052142758'),
(686, '3760085090286'),
(687, '3760108733107'),
(688, '3760108733121'),
(689, '3760108733138'),
(690, '3760108734852'),
(691, '3760108741058'),
(692, '3760108741126'),
(693, '3760119710999'),
(694, '3760125260495'),
(695, '3760140361450'),
(696, '3760205230295'),
(697, '3760240533214'),
(698, '3800020456224'),
(699, '4004181782201'),
(700, '4005086137431'),
(701, '4005086137547'),
(702, '4005086143623'),
(703, '4005086421240'),
(704, '4005556060016'),
(705, '4005556183302'),
(706, '4005556184033'),
(707, '4005556184040'),
(708, '4005556184057'),
(709, '4005556186464'),
(710, '4005556186594'),
(711, '4005556244669'),
(712, '4005556848515'),
(713, '4005556856473'),
(714, '4006149507505'),
(715, '4006149595342'),
(716, '4006166602283'),
(717, '4006592572105'),
(718, '4006874016464'),
(719, '4007176123560'),
(720, '4007176126271'),
(721, '4007817806029'),
(722, '4008496748204'),
(723, '4008789066657'),
(724, '4008789068880'),
(725, '4008789068897'),
(726, '4009775452447'),
(727, '4009775452546'),
(728, '4009775479246'),
(729, '4009847080073'),
(730, '4010070179137'),
(731, '4010070202095'),
(732, '4010070227098'),
(733, '4010070266462'),
(734, '4010070271909'),
(735, '4010070279585'),
(736, '4010070303587'),
(737, '4010070308414'),
(738, '4010070319298'),
(739, '4010070320560'),
(740, '4010070321932'),
(741, '4010070367633'),
(742, '4010168032740'),
(743, '4010168033372'),
(744, '4010168034645'),
(745, '4010168049502'),
(746, '4010168073255'),
(747, '4010168218083'),
(748, '4010168222707'),
(749, '4010168223759'),
(750, '4010168226293'),
(751, '4012390306002'),
(752, '4012390387636'),
(753, '4012927247396'),
(754, '4013594153492'),
(755, '4015731040061'),
(756, '4015731099137'),
(757, '4029811154197'),
(758, '4030651040250'),
(759, '4084900661710'),
(760, '4084900661833'),
(761, '4084900661895'),
(762, '4084900662045'),
(763, '4087205713030'),
(764, '4601798061240'),
(765, '4792247003345'),
(766, '4891813202073'),
(767, '4891813831518'),
(768, '4891813880448'),
(769, '4891813883333'),
(770, '4892910282210'),
(771, '4893993510733'),
(772, '4894367005800'),
(773, '4897059621302'),
(774, '4897059621432'),
(775, '4897067860403'),
(776, '5010065053106'),
(777, '5010065082236'),
(778, '5010993303854'),
(779, '5010993305056'),
(780, '5010993315031'),
(781, '5010993328819'),
(782, '5010993328918'),
(783, '5010993329250'),
(784, '5010993333271'),
(785, '5010993337804'),
(786, '5010993337835'),
(787, '5010993345670'),
(788, '5010993350544'),
(789, '5010993350872'),
(790, '5010993352418'),
(791, '5010993354115'),
(792, '5010993359172'),
(793, '5010993370863'),
(794, '5010993378128'),
(795, '5010993381630'),
(796, '5010993389681'),
(797, '5010993413829'),
(798, '5010993445875'),
(799, '5010994012755'),
(800, '5010994080013'),
(801, '5010994124014'),
(802, '5010994256661'),
(803, '5010994701369'),
(804, '5010994706333'),
(805, '5010994714109'),
(806, '5010994777050'),
(807, '5010994838966'),
(808, '5010994841065'),
(809, '5010994848095'),
(810, '5010994859732'),
(811, '5010994895761'),
(812, '5010994913434'),
(813, '5010994918217'),
(814, '5010994919542'),
(815, '5010994920388'),
(816, '5010994942793'),
(817, '5010994944056'),
(818, '5010994944896'),
(819, '5010994950262'),
(820, '5010994957094'),
(821, '5010994960551'),
(822, '5010994964184'),
(823, '5011666065550'),
(824, '5011666080744'),
(825, '5022103000140'),
(826, '5034566125797'),
(827, '5038278000601'),
(828, '5054131043332'),
(829, '5054131044629'),
(830, '5054131050323'),
(831, '5054131050521'),
(832, '5054131051009'),
(833, '5054131052747'),
(834, '5055285407919'),
(835, '5060264398027'),
(836, '5060264398423'),
(837, '5200701002043'),
(838, '5201184020777'),
(839, '5201184041192'),
(840, '5201184094938'),
(841, '5201184096314'),
(842, '5201184096352'),
(843, '5201184817919'),
(844, '5201184853948'),
(845, '5201184881637'),
(846, '5201184882375'),
(847, '5201184882382'),
(848, '5413538735798'),
(849, '5413538745391'),
(850, '5414561466765'),
(851, '5414561466857'),
(852, '5420025335812'),
(853, '5600983606241'),
(854, '5702014469884'),
(855, '5702015347211'),
(856, '5702016117134'),
(857, '5706751031632'),
(858, '5706751035494'),
(859, '5706751036446'),
(860, '5900951251856'),
(861, '6911400357189'),
(862, '6911400364019'),
(863, '6940176622962'),
(864, '6940176622986'),
(865, '6942138921120'),
(866, '7290006433046'),
(867, '7290013371874'),
(868, '7299830019112'),
(869, '7640116260108'),
(870, '8000825301902'),
(871, '8000825531606'),
(872, '8001011090723'),
(873, '8001011150267'),
(874, '8001011283019'),
(875, '8001011531905'),
(876, '8001444146875'),
(877, '8001444150438'),
(878, '8001444441857'),
(879, '8001444456462'),
(880, '8001478300649'),
(881, '8001478302476'),
(882, '8001478305392'),
(883, '8001478500162'),
(884, '8001478500346'),
(885, '8001478501770'),
(886, '8001478501787'),
(887, '8001478501978'),
(888, '8001478503378'),
(889, '8001478503538'),
(890, '8001478503644'),
(891, '8001478504337'),
(892, '8001478504627'),
(893, '8001478506133'),
(894, '8001478506270'),
(895, '8001478506492'),
(896, '8001478506591'),
(897, '8001478507420'),
(898, '8001478508243'),
(899, '8001478509097'),
(900, '8001478511434'),
(901, '8001478519164'),
(902, '8001478519171'),
(903, '8001537623207'),
(904, '8002595120202'),
(905, '8002752061096'),
(906, '8003029602561'),
(907, '8004927214016'),
(908, '8005125269624'),
(909, '8005125303007'),
(910, '8005125393879'),
(911, '8005125520671'),
(912, '8005125520695'),
(913, '8005125521142'),
(914, '8005125872039'),
(915, '8005125937271'),
(916, '8006612531002'),
(917, '8006812012509'),
(918, '8007315490009'),
(919, '8033576211008'),
(920, '8056379000563'),
(921, '8056379008866'),
(922, '8056379016205'),
(923, '8056379022183'),
(924, '8056379022244'),
(925, '8056379027379'),
(926, '8056379027416'),
(927, '8056379027423'),
(928, '8056379027478'),
(929, '8056379034452'),
(930, '8410446310335'),
(931, '8410446314784'),
(932, '8410446315033'),
(933, '8410779020048'),
(934, '8410788521727'),
(935, '8412147690167'),
(936, '8412668079779'),
(937, '8412668176508'),
(938, '8412906996837'),
(939, '8412906996875'),
(940, '8421134181854'),
(941, '8426420026024'),
(942, '8426420026048'),
(943, '8426420026093'),
(944, '8426420026123'),
(945, '8435333843550'),
(946, '8435333845295'),
(947, '8435333858134'),
(948, '8435333864890'),
(949, '8710675105864'),
(950, '8710675823027'),
(951, '8711808306721'),
(952, '8711808329287'),
(953, '8711808329355'),
(954, '8711808832114'),
(955, '8711808851740'),
(956, '8711866294541'),
(957, '8711915031226'),
(958, '8711915031257'),
(959, '8711915034050'),
(960, '8713291443426'),
(961, '8714274360020'),
(962, '8718226492661'),
(963, '8718226492678'),
(964, '8718637035891'),
(965, '8809134369005'),
(966, '8904001201232'),
(967, '8904001201379'),
(968, '8904001201928'),
(969, '8904001203113'),
(970, '8904001203144'),
(972, '9782012045750'),
(973, '9782016271308');

-- --------------------------------------------------------

--
-- Structure de la table `llx_SKU_exclude`
--

CREATE TABLE `llx_SKU_exclude` (
  `rowid` int(11) NOT NULL,
  `fk_sku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `llx_SKU_exclude`
--

INSERT INTO `llx_SKU_exclude` (`rowid`, `fk_sku`) VALUES
(1, '163015'),
(2, '170756'),
(3, '190757'),
(4, '201504'),
(5, '207576'),
(6, '210720'),
(7, '123609'),
(8, '127847'),
(9, '191344'),
(10, '191345'),
(11, '174132'),
(12, '33104471'),
(13, '159287'),
(14, '217262'),
(15, '212279'),
(16, '223328'),
(17, '208400034'),
(18, '183741'),
(19, '169365'),
(20, '13800650'),
(21, '142680'),
(22, '10804662'),
(23, '181038'),
(24, '204192'),
(25, '160960'),
(26, '133595'),
(27, '170662'),
(28, '33104972'),
(29, '713309'),
(30, '190772'),
(31, '703492'),
(32, '248301'),
(33, '242521'),
(34, '33104989'),
(35, '169912'),
(36, '168566'),
(37, '155794'),
(38, '102976'),
(39, '103310'),
(40, '103572'),
(41, '106282'),
(42, '10802666'),
(43, '10803820'),
(44, '10803984'),
(45, '10804641'),
(46, '121051'),
(47, '123194'),
(48, '123780'),
(49, '129084'),
(50, '129183'),
(51, '133248'),
(52, '138484'),
(53, '145980'),
(54, '146933'),
(55, '159458'),
(56, '161693'),
(57, '161926'),
(58, '168578'),
(59, '168665'),
(60, '168704'),
(61, '172942'),
(62, '175129'),
(63, '175349'),
(64, '177011'),
(65, '177681'),
(66, '180489'),
(67, '181485'),
(68, '181486'),
(69, '185394'),
(70, '186656'),
(71, '186875'),
(72, '187190'),
(73, '187441'),
(74, '188933'),
(75, '188940'),
(76, '188981'),
(77, '188982'),
(78, '191038'),
(79, '191317'),
(80, '191699'),
(81, '193635'),
(82, '194763'),
(83, '198054'),
(84, '198942'),
(85, '200169'),
(86, '200251'),
(87, '204907'),
(88, '204940'),
(89, '205402'),
(90, '206702015'),
(91, '206702272'),
(92, '206702340'),
(93, '206702345'),
(94, '207814'),
(95, '207900033'),
(96, '207900096'),
(97, '208269'),
(98, '208400101'),
(99, '208400164'),
(100, '208400202'),
(101, '208400206'),
(102, '208961'),
(103, '209222'),
(104, '210712'),
(105, '211366'),
(106, '212777'),
(107, '214214'),
(108, '215139'),
(109, '216556'),
(110, '216557'),
(111, '216768'),
(112, '217588'),
(113, '218840'),
(114, '218858'),
(115, '219374'),
(116, '219890'),
(117, '221148'),
(118, '221507'),
(119, '221540'),
(120, '222027'),
(121, '222543'),
(122, '222796'),
(123, '223318'),
(124, '224378'),
(125, '224405'),
(126, '225737'),
(127, '226502'),
(128, '226728'),
(129, '226781'),
(130, '228081'),
(131, '228097'),
(132, '228916'),
(133, '228918'),
(134, '228919'),
(135, '229420'),
(136, '229835'),
(137, '233365'),
(138, '234066'),
(139, '234147'),
(140, '235268'),
(141, '236028'),
(142, '236490'),
(143, '236650'),
(144, '236652'),
(145, '236734'),
(146, '236735'),
(147, '236914'),
(148, '236915'),
(149, '236926'),
(150, '237081'),
(151, '237224'),
(152, '237227'),
(153, '238144'),
(154, '239103'),
(155, '239449'),
(156, '239612'),
(157, '241836'),
(158, '241838'),
(159, '242016'),
(160, '242311'),
(161, '242328'),
(162, '242335'),
(163, '242336'),
(164, '242855'),
(165, '243242'),
(166, '243254'),
(167, '243661'),
(168, '247436'),
(169, '247648'),
(170, '247649'),
(171, '302805'),
(172, '32452'),
(173, '33102283'),
(174, '33104187'),
(175, '33104210'),
(176, '68845'),
(177, '703414'),
(178, '703417'),
(179, '704106'),
(180, '704118'),
(181, '706604'),
(182, '707421'),
(183, '711525'),
(184, '711927'),
(185, '712741'),
(186, '87428'),
(187, '87430'),
(188, '92000'),
(189, '93162'),
(190, '95551'),
(191, '95558'),
(192, '97740'),
(193, '98195'),
(194, '98197'),
(195, '248261'),
(196, '101644'),
(197, '10804366'),
(198, '10804669'),
(199, '10804670'),
(200, '111688'),
(201, '116276'),
(202, '116326'),
(203, '118942'),
(204, '122801'),
(205, '123785'),
(206, '125849'),
(207, '126718'),
(208, '130387'),
(209, '135695'),
(210, '13800679'),
(211, '13800692'),
(212, '150046'),
(213, '152184'),
(214, '155621'),
(215, '161236'),
(216, '168441'),
(217, '168719'),
(218, '169919'),
(219, '170622'),
(220, '172691'),
(221, '178956'),
(222, '184843'),
(223, '186882'),
(224, '186919'),
(225, '191895'),
(226, '191973'),
(227, '199861'),
(228, '202772'),
(229, '206701117'),
(230, '206701118'),
(231, '206701597'),
(232, '206702171'),
(233, '206702219'),
(234, '206702250'),
(235, '206702343'),
(236, '207402'),
(237, '207700084'),
(238, '207700130'),
(239, '207700279'),
(240, '207900007'),
(241, '207900027'),
(242, '207900037'),
(243, '207900043'),
(244, '210373'),
(245, '214658'),
(246, '220824'),
(247, '221217'),
(248, '221841'),
(249, '222059'),
(250, '222867'),
(251, '224962'),
(252, '225506'),
(253, '225512'),
(254, '226077'),
(255, '226209'),
(256, '226210'),
(257, '226211'),
(258, '226226'),
(259, '226359'),
(260, '227512'),
(261, '228056'),
(262, '23169'),
(263, '235178'),
(264, '235462'),
(265, '236770'),
(266, '236806'),
(267, '236920'),
(268, '237197'),
(269, '238380'),
(270, '240752'),
(271, '241643'),
(272, '243245'),
(273, '243249'),
(274, '245347'),
(275, '245808'),
(276, '246146'),
(277, '246147'),
(278, '246175'),
(279, '246179'),
(280, '246251'),
(281, '246252'),
(282, '248665'),
(283, '250474'),
(284, '4910'),
(285, '64543'),
(286, '702134'),
(287, '703074'),
(288, '703143'),
(289, '704114'),
(290, '704120'),
(291, '704319'),
(292, '704320'),
(293, '704321'),
(294, '704429'),
(295, '704440'),
(296, '704993'),
(297, '705077'),
(298, '705078'),
(299, '705155'),
(300, '705232'),
(301, '707500'),
(302, '707737'),
(303, '708885'),
(304, '83316'),
(305, '99057'),
(306, '99058'),
(307, '239762'),
(308, '240106'),
(309, '101093'),
(310, '102801'),
(311, '103291'),
(312, '103662'),
(313, '106328'),
(314, '10801502'),
(315, '10801503'),
(316, '10802585'),
(317, '10802628'),
(318, '10803804'),
(319, '10803978'),
(320, '10803982'),
(321, '10803989'),
(322, '10804170'),
(323, '10804375'),
(324, '10804601'),
(325, '10804643'),
(326, '108701'),
(327, '111626'),
(328, '111783'),
(329, '116946'),
(330, '116960'),
(331, '119007'),
(332, '121058'),
(333, '123389'),
(334, '123741'),
(335, '12418'),
(336, '124244'),
(337, '127896'),
(338, '128910'),
(339, '130181'),
(340, '130184'),
(341, '132158'),
(342, '135495'),
(343, '136625'),
(344, '139232'),
(345, '139453'),
(346, '140977'),
(347, '147721'),
(348, '148836'),
(349, '152705'),
(350, '153713'),
(351, '158486'),
(352, '161739'),
(353, '161997'),
(354, '162027'),
(355, '162581'),
(356, '170760'),
(357, '171112'),
(358, '171415'),
(359, '171424'),
(360, '171462'),
(361, '171463'),
(362, '172552'),
(363, '172554'),
(364, '173158'),
(365, '175124'),
(366, '175127'),
(367, '1771'),
(368, '177522'),
(369, '178754'),
(370, '179632'),
(371, '181035'),
(372, '181143'),
(373, '185185'),
(374, '185280'),
(375, '186894'),
(376, '187251'),
(377, '187710'),
(378, '187775'),
(379, '187821'),
(380, '188523'),
(381, '188887'),
(382, '189115'),
(383, '191123'),
(384, '191127'),
(385, '191335'),
(386, '191336'),
(387, '192876'),
(388, '193294'),
(389, '193532'),
(390, '193636'),
(391, '193650'),
(392, '195750'),
(393, '198577'),
(394, '201884'),
(395, '202778'),
(396, '204759'),
(397, '204904'),
(398, '204920'),
(399, '206700999'),
(400, '206702216'),
(401, '206702334'),
(402, '206702346'),
(403, '206791'),
(404, '206802'),
(405, '206893'),
(406, '206976'),
(407, '207141'),
(408, '207663'),
(409, '207700113'),
(410, '207700128'),
(411, '207700438'),
(412, '207700460'),
(413, '207700497'),
(414, '207700499'),
(415, '207900092'),
(416, '207900133'),
(417, '208017'),
(418, '208096'),
(419, '208400005'),
(420, '208400187'),
(421, '208400205'),
(422, '208400208'),
(423, '208400211'),
(424, '208400214'),
(425, '208400215'),
(426, '208400220'),
(427, '208771'),
(428, '209018'),
(429, '209039'),
(430, '209118'),
(431, '209624'),
(432, '209944'),
(433, '211174'),
(434, '211762'),
(435, '213462'),
(436, '213694'),
(437, '215143'),
(438, '216492'),
(439, '217698'),
(440, '218157'),
(441, '218252'),
(442, '219126'),
(443, '219135'),
(444, '219294'),
(445, '220333'),
(446, '221282'),
(447, '221348'),
(448, '221671'),
(449, '221901'),
(450, '222025'),
(451, '222488'),
(452, '222600'),
(453, '222851'),
(454, '222868'),
(455, '223338'),
(456, '223996'),
(457, '224346'),
(458, '225234'),
(459, '225400'),
(460, '225526'),
(461, '225784'),
(462, '226100'),
(463, '226108'),
(464, '226525'),
(465, '226878'),
(466, '226882'),
(467, '227375'),
(468, '227912'),
(469, '228121'),
(470, '228123'),
(471, '228133'),
(472, '228145'),
(473, '228360'),
(474, '228462'),
(475, '228937'),
(476, '229066'),
(477, '230570'),
(478, '232709'),
(479, '232978'),
(480, '232980'),
(481, '233205'),
(482, '233208'),
(483, '233211'),
(484, '233238'),
(485, '233310'),
(486, '234137'),
(487, '236587'),
(488, '236898'),
(489, '236994'),
(490, '237364'),
(491, '237368'),
(492, '237369'),
(493, '237404'),
(494, '237421'),
(495, '237452'),
(496, '237454'),
(497, '237457'),
(498, '237458'),
(499, '237460'),
(500, '237469'),
(501, '237479'),
(502, '237480'),
(503, '237482'),
(504, '237483'),
(505, '237487'),
(506, '237499'),
(507, '237508'),
(508, '237509'),
(509, '240694'),
(510, '240850'),
(511, '241310'),
(512, '241522'),
(513, '242075'),
(514, '242085'),
(515, '242116'),
(516, '242246'),
(517, '242933'),
(518, '243510'),
(519, '243667'),
(520, '243670'),
(521, '243721'),
(522, '244657'),
(523, '244681'),
(524, '244682'),
(525, '244689'),
(526, '244741'),
(527, '245157'),
(528, '245442'),
(529, '245497'),
(530, '245499'),
(531, '245557'),
(532, '245594'),
(533, '246148'),
(534, '246254'),
(535, '246263'),
(536, '248645'),
(537, '248676'),
(538, '249619'),
(539, '250546'),
(540, '250547'),
(541, '26748'),
(542, '29450'),
(543, '2979'),
(544, '300620'),
(545, '33101464'),
(546, '33103876'),
(547, '33104687'),
(548, '33104731'),
(549, '33104872'),
(550, '33104943'),
(551, '33104945'),
(552, '35444'),
(553, '38864'),
(554, '39049'),
(555, '400128'),
(556, '45169'),
(557, '58843'),
(558, '62369'),
(559, '64052'),
(560, '64214'),
(561, '64933'),
(562, '701010'),
(563, '701013'),
(564, '701212'),
(565, '701272'),
(566, '701333'),
(567, '701401'),
(568, '701424'),
(569, '701857'),
(570, '701949'),
(571, '702195'),
(572, '702673'),
(573, '703065'),
(574, '703066'),
(575, '703218'),
(576, '703445'),
(577, '703589'),
(578, '705210'),
(579, '706195'),
(580, '706482'),
(581, '706486'),
(582, '706564'),
(583, '707039'),
(584, '707040'),
(585, '707041'),
(586, '707042'),
(587, '707254'),
(588, '707259'),
(589, '707260'),
(590, '707288'),
(591, '707292'),
(592, '707357'),
(593, '707376'),
(594, '707411'),
(595, '707537'),
(596, '707887'),
(597, '708114'),
(598, '710425'),
(599, '710879'),
(600, '711714'),
(601, '714488'),
(602, '82343'),
(603, '84398'),
(604, '95967'),
(605, '97177'),
(606, '94415'),
(607, '97991'),
(608, '214591'),
(609, '703245'),
(610, '228470'),
(611, '144866'),
(612, '709118'),
(613, '226579'),
(614, '33103499'),
(615, '249628'),
(616, '204151'),
(617, '157012'),
(618, '178427'),
(619, '218204'),
(620, '33102321'),
(621, '232319'),
(622, '216338'),
(623, '248433'),
(624, '146864'),
(625, '702784'),
(626, '148215'),
(627, '162576'),
(628, '162584'),
(629, '242222'),
(630, '211737'),
(631, '161556'),
(632, '193298'),
(633, '216417'),
(634, '241783'),
(635, '241784'),
(636, '241785'),
(637, '215244'),
(638, '21102'),
(639, '393351'),
(640, '33104490'),
(641, '221677'),
(642, '102639'),
(643, '214117'),
(644, '10802654'),
(645, '204924'),
(646, '78519164'),
(647, '192544'),
(648, '700054'),
(649, '712244'),
(650, '712243'),
(651, '204925'),
(652, '189528'),
(653, '222768'),
(654, '191357'),
(655, '208329'),
(656, '208339'),
(657, '208351'),
(658, '208344'),
(659, '208325'),
(660, '191841'),
(661, '232886'),
(662, '208333'),
(663, '246589'),
(664, '705501'),
(665, '243430'),
(666, '226603'),
(667, '243762'),
(668, '98255'),
(669, '9594'),
(670, '96229'),
(671, '711947'),
(672, '221483'),
(673, '153516'),
(674, '236244'),
(675, '236245'),
(676, '239701'),
(677, '219597'),
(678, '207900142'),
(679, '205522'),
(680, '183534'),
(681, '219049'),
(682, '30001896'),
(683, '221349'),
(684, '245392'),
(685, '698'),
(686, '703643'),
(687, '703644'),
(688, '703647'),
(689, '703652'),
(690, '703654'),
(691, '703655'),
(692, '206702394'),
(693, '236441'),
(694, '214633'),
(695, '13800645'),
(696, '212300'),
(697, '199265'),
(698, '703650'),
(699, '87731479'),
(700, '239061'),
(701, '206702408'),
(702, '221232'),
(703, '211002'),
(704, '10802600'),
(705, '233716'),
(706, '240161'),
(707, '217228'),
(708, '238346'),
(709, '704318'),
(710, '130005'),
(711, '10801860'),
(712, '206702410'),
(713, '707632'),
(714, '302692'),
(715, '250018'),
(716, '242063'),
(717, '220306'),
(718, '708842'),
(719, '221778'),
(720, '704024'),
(721, '188945'),
(722, '188946'),
(723, '182543'),
(724, '190725'),
(725, '118282'),
(726, '204348'),
(727, '236313'),
(728, '719014'),
(729, '131227'),
(730, '87437'),
(731, '705337'),
(732, '718805'),
(733, '94809'),
(734, '703054'),
(735, '17811028'),
(736, '206702395'),
(737, '162597'),
(738, '159349'),
(739, '208327'),
(740, '249011'),
(741, '181126'),
(742, '153080'),
(743, '225228'),
(744, '200224'),
(745, '155722'),
(746, '105477'),
(747, '61501022'),
(748, '167341'),
(749, '243223'),
(750, '239428'),
(751, '183455'),
(752, '170132'),
(753, '33104427'),
(754, '169930'),
(755, '191838'),
(756, '153977'),
(757, '155792'),
(758, '177217'),
(759, '113572'),
(760, '13800087'),
(761, '93340453'),
(762, '33101635'),
(763, '202638'),
(764, 'ADBB-RG02-B'),
(765, '72829'),
(766, '159347'),
(767, '162591'),
(768, '208331'),
(769, '208332'),
(770, '208334'),
(771, '704189'),
(772, 'ADBB-OB-10311'),
(773, '211738'),
(774, '704188'),
(775, '33104833'),
(776, 'ADBB-302432'),
(777, 'ADBB-302433 '),
(778, 'ADBB-3800171 '),
(779, 'ADBB-3800172 '),
(780, 'ADBB-200110 '),
(781, '206702415'),
(782, '33104379'),
(783, '147221'),
(784, '242223'),
(785, '210924'),
(786, 'ADBB-8075021'),
(787, '712009'),
(788, 'ADBB-302427'),
(789, '179209'),
(790, '198775'),
(791, '33104979'),
(792, '242055'),
(793, '229280'),
(794, '228887'),
(795, '715476'),
(796, '208336'),
(797, '701109'),
(798, '161374'),
(799, '166739'),
(800, '704027'),
(801, '202368'),
(802, '151502'),
(803, '105300'),
(804, '174347'),
(805, '226991'),
(806, '162580'),
(807, '162577'),
(808, '717045'),
(809, '712347'),
(810, 'ADBB-302435'),
(811, '720755'),
(812, '206702475'),
(813, '159296'),
(814, '142726'),
(815, '87422'),
(816, '244306'),
(817, '116691'),
(818, '717053'),
(819, 'ADBB-302425'),
(820, '705955'),
(821, '10804745'),
(822, '144376'),
(823, '712548'),
(824, '236693'),
(825, '236692'),
(826, '150679'),
(827, '10804698'),
(828, '123069'),
(829, '705669'),
(830, '33104156'),
(831, '711156'),
(832, '206702439'),
(833, '705961'),
(834, '236718'),
(835, '219045'),
(836, '711431'),
(837, '717197'),
(838, '248066'),
(839, '711903'),
(840, '245313'),
(841, '236933'),
(842, '5939'),
(843, '242941'),
(844, '712631'),
(845, '204892'),
(846, 'ADBB-OB-10311'),
(847, '216766'),
(848, '705474'),
(849, '10804652'),
(850, '208184'),
(851, '238025'),
(852, '237300'),
(853, '106652'),
(854, 'ADBB-R20314'),
(855, '708594'),
(856, '235155'),
(857, '33105180'),
(858, '243185'),
(859, '192187'),
(860, '223019'),
(861, '714409'),
(862, '167456'),
(863, '703341'),
(864, '168289'),
(865, '163791'),
(866, '33104975'),
(867, '168335'),
(868, '168338'),
(869, '130369'),
(870, '190103'),
(871, '721481'),
(872, '153463'),
(873, '704965'),
(874, '224940'),
(875, 'ADBB-126816'),
(876, '208400347'),
(877, '722692'),
(878, '722691'),
(879, '386264'),
(880, '523104'),
(881, '243182'),
(882, '141192'),
(883, '208335'),
(884, 'ADBB-B-DODOUCV0109BEIGE0/6'),
(885, 'ADBB-B-DODOUCV0261BEIGE6/12'),
(886, 'ADBB-J-STKROMCHR'),
(887, 'ADBB-B-DC2580'),
(888, 'ADBB-B-11735'),
(889, 'ADBB-B-JSCG'),
(890, 'ADBB-B-COLLINEA0151MARINE3/6'),
(891, 'ADBB-B-GENEVE BORDEAUX M'),
(892, 'ADBB-B-E13-3410'),
(893, 'ADBB-B-E13-3411'),
(894, 'ADBB-B-E13-3408'),
(895, 'ADBB-B-8075033'),
(896, '709386'),
(897, '704008'),
(898, 'ADBB-R20311'),
(899, '719320'),
(900, '224902'),
(901, '124300'),
(902, '132262'),
(903, '13800878'),
(904, '138000880'),
(905, '711437'),
(906, '712362'),
(907, '226091'),
(908, '719319'),
(909, '134587'),
(910, '13800880'),
(911, '243711'),
(912, '243723'),
(913, '712528'),
(914, '235186'),
(915, '706062'),
(916, '706776'),
(917, '10801148'),
(918, '9166'),
(919, 'JC-85002-1'),
(920, '91661'),
(921, '382949'),
(922, 'JC-284454'),
(923, 'JC-262271'),
(924, '101882'),
(925, 'ADBB-B-4342'),
(926, '88855'),
(927, '142728'),
(928, 'ADBB-B-8092029'),
(929, 'ADBB-SC-15'),
(930, 'ADBB-J-STLITRAX4CHR'),
(931, 'JC-356455'),
(932, 'JC-SCF-328A02'),
(933, '224899'),
(934, '228605'),
(935, '206702732'),
(936, '720557'),
(937, '224901'),
(938, 'JC-6213825'),
(939, '206702733'),
(940, '714777'),
(941, 'JC-702212'),
(942, '33104956'),
(943, '119821'),
(944, '710872'),
(945, 'JC-900115'),
(946, 'ADBB-B-40100'),
(947, '721178'),
(948, '723362'),
(949, '198791'),
(950, '704054'),
(951, 'ADBB-R20192'),
(952, '722427'),
(953, '93039'),
(954, '160276'),
(955, '722425'),
(956, '702036'),
(957, '702038'),
(958, '199923'),
(959, '702037'),
(960, '702039'),
(961, '702040'),
(962, 'ADBB-R20314'),
(963, 'JC-7/212056001002'),
(964, '223337'),
(965, 'JC-TE143'),
(966, 'ADBB-B-60346'),
(967, 'JC-EU720220A'),
(968, '115238'),
(969, '82964'),
(970, '24578'),
(971, 'ADBB-B-40311'),
(972, 'ADBB-B-BAS1-GRE'),
(973, 'ADBB-B-WB-PAS413'),
(974, 'ADBB-B-WB-CIT406'),
(975, '223587'),
(976, '147415'),
(977, 'ADBB-B-SCF755/05'),
(978, 'ADBB-B-0307'),
(979, 'ADBB-B-SCF755/03'),
(980, 'JC-71820'),
(981, 'JC-71818'),
(982, '94416'),
(983, 'JC-80-602155'),
(984, '94418'),
(985, '177216'),
(986, '177216'),
(987, '94419'),
(988, 'ADBB-B-P0K405'),
(989, 'ADBB-B-01007899'),
(990, 'ADBB-B-40246-EU-01'),
(991, 'JC-400148'),
(992, 'ADBB-B-S98230'),
(993, '723254'),
(994, '723361'),
(995, '243504'),
(996, '722426'),
(997, 'ADBB-523515'),
(998, 'JC-10873'),
(999, 'ADBB-B-S98974'),
(1000, '717941'),
(1001, '702401'),
(1002, '49149'),
(1003, '723212'),
(1004, 'JC-2602/3602');

-- --------------------------------------------------------

--
-- Structure de la table `llx_Terms_exclude`
--

CREATE TABLE `llx_Terms_exclude` (
  `rowid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `llx_Terms_exclude`
--

INSERT INTO `llx_Terms_exclude` (`rowid`, `name`) VALUES
(1, 'ASST'),
(2, 'ASSORT'),
(4, 'ASSORTIS'),
(6, 'DISPLAY'),
(7, 'ASSOT'),
(8, 'Assortment'),
(9, 'Assortiment'),
(10, 'ASSNO');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `llx_EAN_exclude`
--
ALTER TABLE `llx_EAN_exclude`
  ADD PRIMARY KEY (`rowid`),
  ADD UNIQUE KEY `FK_fk_ean` (`fk_ean`);

--
-- Index pour la table `llx_SKU_exclude`
--
ALTER TABLE `llx_SKU_exclude`
  ADD PRIMARY KEY (`rowid`);

--
-- Index pour la table `llx_Terms_exclude`
--
ALTER TABLE `llx_Terms_exclude`
  ADD PRIMARY KEY (`rowid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `llx_EAN_exclude`
--
ALTER TABLE `llx_EAN_exclude`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3490;

--
-- AUTO_INCREMENT pour la table `llx_SKU_exclude`
--
ALTER TABLE `llx_SKU_exclude`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT pour la table `llx_Terms_exclude`
--
ALTER TABLE `llx_Terms_exclude`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;