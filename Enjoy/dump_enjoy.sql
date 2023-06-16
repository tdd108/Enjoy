--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.19
-- Dumped by pg_dump version 11.7 (Debian 11.7-0+deb10u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commande (
    id_com integer NOT NULL,
    montant numeric(5,2),
    statut_com character varying(10) DEFAULT 'attente'::character varying,
    email_ult character varying(50),
    nom_res character varying(25),
    mat_liv character varying(25),
    CONSTRAINT commande_statut_com_check CHECK (((statut_com)::text = ANY ((ARRAY['attente'::character varying, 'accepte'::character varying, 'livre'::character varying])::text[])))
);


ALTER TABLE public.commande OWNER TO "postgres";

--
-- Name: commande_id_com_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commande_id_com_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commande_id_com_seq OWNER TO "postgres";

--
-- Name: commande_id_com_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commande_id_com_seq OWNED BY public.commande.id_com;


--
-- Name: commentaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commentaire (
    email_ult character varying(50),
    nom_res character varying(25),
    contenu text,
    note integer
);


ALTER TABLE public.commentaire OWNER TO "postgres";

--
-- Name: contient; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contient (
    id_com integer NOT NULL,
    nom_plat character varying(25),
    quantite integer NOT NULL
);


ALTER TABLE public.contient OWNER TO "postgres";

--
-- Name: contient_id_com_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contient_id_com_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contient_id_com_seq OWNER TO "postgres";

--
-- Name: contient_id_com_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contient_id_com_seq OWNED BY public.contient.id_com;


--
-- Name: livreur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.livreur (
    mat_liv character varying(25) NOT NULL,
    mdp_liv character varying(25) NOT NULL,
    nom_liv character varying(25) NOT NULL,
    prenom_liv character varying(25) NOT NULL,
    tel_liv character varying(10) NOT NULL,
    statut_liv character varying(20) DEFAULT 'indisponbile'::character varying,
    code_postal_liv character varying(25),
    CONSTRAINT livreur_statut_liv_check CHECK (((statut_liv)::text = ANY ((ARRAY['attente'::character varying, 'accepte'::character varying, 'indisponible'::character varying])::text[])))
);


ALTER TABLE public.livreur OWNER TO "postgres";

--
-- Name: parraine; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.parraine (
    email_ult character varying(50),
    email_u_parrain character varying(50)
);


ALTER TABLE public.parraine OWNER TO "postgres";

--
-- Name: plat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plat (
    nom_plat text NOT NULL,
    prix numeric(5,2),
    desc_plat text,
    photo_url text
);


ALTER TABLE public.plat OWNER TO "postgres";

--
-- Name: proposer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proposer (
    nom_res character varying(50),
    nom_plat text
);


ALTER TABLE public.proposer OWNER TO "postgres";

--
-- Name: restaurant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.restaurant (
    nom_res character varying(50) NOT NULL,
    adresse_res text NOT NULL,
    horrais_ouvri time without time zone,
    horrais_ferme time without time zone,
    mot_clef text,
    statut_res character varying(20) DEFAULT 'indisponbile'::character varying,
    code_postal_res character varying(25),
    CONSTRAINT restaurant_statut_res_check CHECK (((statut_res)::text = ANY ((ARRAY['disponible'::character varying, 'indisponible'::character varying])::text[])))
);


ALTER TABLE public.restaurant OWNER TO "postgres";

--
-- Name: ultilisateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ultilisateur (
    email_ult character varying(50) NOT NULL,
    mdp_ult character varying(25) NOT NULL,
    nom_ult character varying(25) NOT NULL,
    prenom_ult character varying(25) NOT NULL,
    adresse_ult character varying(50) NOT NULL,
    tel_ult character varying(10) NOT NULL,
    carte_bancaire character varying(20) NOT NULL,
    point_ult integer DEFAULT 0,
    code_postal_ult character varying(25)
);


ALTER TABLE public.ultilisateur OWNER TO "postgres";

--
-- Name: ville; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ville (
    code_postal character varying(25) NOT NULL,
    nom_vil character varying(25) NOT NULL
);


ALTER TABLE public.ville OWNER TO "postgres";

--
-- Name: commande id_com; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande ALTER COLUMN id_com SET DEFAULT nextval('public.commande_id_com_seq'::regclass);


--
-- Name: contient id_com; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contient ALTER COLUMN id_com SET DEFAULT nextval('public.contient_id_com_seq'::regclass);


--
-- Data for Name: commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commande (id_com, montant, statut_com, email_ult, nom_res, mat_liv) FROM stdin;
1	24.00	accepte	QarthVincent39@mail.com	Creme de la Crepe	JSNZVKINLGPTL4PZG19I
2	36.00	accepte	FannotWilliam24@mail.com	Crust	D1CC6LM8OTG320VYV4R8
3	34.00	accepte	FannotWilliam24@mail.com	Crust	BJXHHB7751KKEUPH697G
4	30.00	livre	LemoineSylvain51@mail.com	Crust	O8TOJTT4CQIPQVL6EYSV
5	34.00	attente	ChaslesOmar30@mail.com	Boulud Sud	\N
\.


--
-- Data for Name: commentaire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commentaire (email_ult, nom_res, contenu, note) FROM stdin;
LemoineSylvain51@mail.com	Crust	Je recommande a 100% ce restaurant, Nous avons super bien manger, Serveuse agréable souriante.	5
\.


--
-- Data for Name: contient; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contient (id_com, nom_plat, quantite) FROM stdin;
1	appetizer Appetizing	2
1	barley Blazed	1
2	appetite Candied	1
3	bitter prickly	1
4	daily bread Edible	1
5	buns Blazed	1
\.


--
-- Data for Name: livreur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.livreur (mat_liv, mdp_liv, nom_liv, prenom_liv, tel_liv, statut_liv, code_postal_liv) FROM stdin;
KJORFU4FTQS7T7T82ECP	JRI1J0WGQP	Bouris	Ophélie	905136898	attente	93330
MYRLQF4F9D45M6GTJIYM	9ED6GBKA9J	Hadrien	Ulysse	878160804	attente	93360
4B87V2ALJR961YIKTV35	SF5YZ1Q6RN	Albert	Bruno	692362934	attente	93360
O8TOJTT4CQIPQVL6EYSV	QBN8GLFT1H	Girard	Ulysse	680804334	attente	93160
JSNZVKINLGPTL4PZG19I	4D48DK08NV	Sauveur	Louis	872135500	accepte	93330
AMZ996JX7L58QWH5TRQI	717N852IXI	Dupond	Amélie	580821361	indisponible	93130
K6GEXP8PEFA1N7WY5108	E3IZS6OFUE	Bouris	Eve	92958103	indisponible	93160
D1CC6LM8OTG320VYV4R8	1TMJBV76OL	Albert	Hugues	180572063	accepte	93360
BJXHHB7751KKEUPH697G	YNA3VRX13M	Marie	Natacha	626866135	accepte	93130
TZO7Q174CK3QBL7HDLUF	7AV0764GVY	Imon	Charlie	433407855	attente	93160
\.


--
-- Data for Name: parraine; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.parraine (email_ult, email_u_parrain) FROM stdin;
QarthVincent39@mail.com	ChaslesFrançois26@mail.com
LemoineSylvain51@mail.com	NguyenManon23@mail.com
FannotWilliam24@mail.com	QarthVincent39@mail.com
LemoineSylvain51@mail.com	ChaslesFrançois26@mail.com
AlbertNoémie58@mail.com	ChaslesOmar30@mail.com
ChaslesFrançois26@mail.com	ImonQueene62@mail.com
AlbertNoémie58@mail.com	HadrienDiane50@mail.com
LemoineSylvain51@mail.com	ChaslesOmar30@mail.com
ImonQueene62@mail.com	OrchidThomas33@mail.com
QarthVincent39@mail.com	AlbertNoémie58@mail.com
\.


--
-- Data for Name: plat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.plat (nom_plat, prix, desc_plat, photo_url) FROM stdin;
biscuit Balsamic	9.00	description of biscuit Balsamicdish	https//urlbiscuit Balsamic
chopsticks chow pleasant	32.00	description of chopsticks chow pleasantdish	https//urlchopsticks chow pleasant
dinner organic	29.00	description of dinner organicdish	https//urldinner organic
dandelion greens Danish pastry dates Free	13.00	description of dandelion greens Danish pastry dates Freedish	https//urldandelion greens Danish pastry dates Free
barley Blazed	12.00	description of barley Blazeddish	https//urlbarley Blazed
cinnamon nutty	23.00	description of cinnamon nuttydish	https//urlcinnamon nutty
black tea overpowering	24.00	description of black tea overpoweringdish	https//urlblack tea overpowering
acorn squash Filet	31.00	description of acorn squash Filetdish	https//urlacorn squash Filet
burrito Chunked	40.00	description of burrito Chunkeddish	https//urlburrito Chunked
appetizer Candied	49.00	description of appetizer Candieddish	https//urlappetizer Candied
buns Blazed	34.00	description of buns Blazeddish	https//urlbuns Blazed
broccoli mixture of	33.00	description of broccoli mixture ofdish	https//urlbroccoli mixture of
citrus Chocolate	15.00	description of citrus Chocolatedish	https//urlcitrus Chocolate
butter non-fat	17.00	description of butter non-fatdish	https//urlbutter non-fat
horseradish hot pleasant	48.00	description of horseradish hot pleasantdish	https//urlhorseradish hot pleasant
cayenne pepper celery Acidic	38.00	description of cayenne pepper celery Acidicdish	https//urlcayenne pepper celery Acidic
cantaloupe prepared	40.00	description of cantaloupe prepareddish	https//urlcantaloupe prepared
beef Cheesy	48.00	description of beef Cheesydish	https//urlbeef Cheesy
daily bread peppery	34.00	description of daily bread pepperydish	https//urldaily bread peppery
brownie Crisp	24.00	description of brownie Crispdish	https//urlbrownie Crisp
hamburger hash Flavorful	13.00	description of hamburger hash Flavorfuldish	https//urlhamburger hash Flavorful
cassava Briny	29.00	description of cassava Brinydish	https//urlcassava Briny
bran Flat	27.00	description of bran Flatdish	https//urlbran Flat
broil Delicious	29.00	description of broil Deliciousdish	https//urlbroil Delicious
basil Acidic	46.00	description of basil Acidicdish	https//urlbasil Acidic
appetizer Appetizing	6.00	description of appetizer Appetizingdish	https//urlappetizer Appetizing
batter natural	48.00	description of batter naturaldish	https//urlbatter natural
baked Alaska Appealing	7.00	description of baked Alaska Appealingdish	https//urlbaked Alaska Appealing
Brussels sprouts buckwheat poached	49.00	description of Brussels sprouts buckwheat poacheddish	https//urlBrussels sprouts buckwheat poached
hummus Bland	43.00	description of hummus Blanddish	https//urlhummus Bland
breadfruit mellow	25.00	description of breadfruit mellowdish	https//urlbreadfruit mellow
bacon Dripping	49.00	description of bacon Drippingdish	https//urlbacon Dripping
cereal plain	41.00	description of cereal plaindish	https//urlcereal plain
hamburger hash Dull	20.00	description of hamburger hash Dulldish	https//urlhamburger hash Dull
black beans Luscious	8.00	description of black beans Lusciousdish	https//urlblack beans Luscious
bitter prickly	34.00	description of bitter pricklydish	https//urlbitter prickly
cereal Flaky	31.00	description of cereal Flakydish	https//urlcereal Flaky
appetite Candied	36.00	description of appetite Candieddish	https//urlappetite Candied
daily bread Flavorful	30.00	description of daily bread Flavorfuldish	https//urldaily bread Flavorful
herbs Chocolate	34.00	description of herbs Chocolatedish	https//urlherbs Chocolate
cayenne pepper celery overpowering	11.00	description of cayenne pepper celery overpoweringdish	https//urlcayenne pepper celery overpowering
diner Brown	49.00	description of diner Browndish	https//urldiner Brown
breadfruit mellow1	6.00	description of breadfruit mellowdish	https//urlbreadfruit mellow
broil plump	5.00	description of broil plumpdish	https//urlbroil plump
casserole Blazed	8.00	description of casserole Blazeddish	https//urlcasserole Blazed
diner mellow	16.00	description of diner mellowdish	https//urldiner mellow
daily bread Edible	29.00	description of daily bread Edibledish	https//urldaily bread Edible
Brussels sprouts buckwheat Edible	44.00	description of Brussels sprouts buckwheat Edibledish	https//urlBrussels sprouts buckwheat Edible
bagel Flavored	6.00	description of bagel Flavoreddish	https//urlbagel Flavored
barley mashed	7.00	description of barley masheddish	https//urlbarley mashed
\.


--
-- Data for Name: proposer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.proposer (nom_res, nom_plat) FROM stdin;
Au Revoir French Bistro	biscuit Balsamic
Au Revoir French Bistro	chopsticks chow pleasant
Au Revoir French Bistro	dinner organic
Au Revoir French Bistro	dandelion greens Danish pastry dates Free
Au Revoir French Bistro	barley Blazed
Blue Moon Over Avila	cinnamon nutty
Blue Moon Over Avila	black tea overpowering
Blue Moon Over Avila	acorn squash Filet
Blue Moon Over Avila	burrito Chunked
Blue Moon Over Avila	appetizer Candied
Boulud Sud	buns Blazed
Boulud Sud	broccoli mixture of
Boulud Sud	citrus Chocolate
Boulud Sud	butter non-fat
Boulud Sud	horseradish hot pleasant
Cafe Des Artistes	cayenne pepper celery Acidic
Cafe Des Artistes	cantaloupe prepared
Cafe Des Artistes	beef Cheesy
Cafe Des Artistes	daily bread peppery
Cafe Des Artistes	brownie Crisp
Chez Maman	hamburger hash Flavorful
Chez Maman	cassava Briny
Chez Maman	bran Flat
Chez Maman	broil Delicious
Chez Maman	basil Acidic
Cocotte	appetizer Appetizing
Cocotte	batter natural
Cocotte	baked Alaska Appealing
Cocotte	Brussels sprouts buckwheat poached
Cocotte	hummus Bland
Creme de la Crepe	breadfruit mellow
Creme de la Crepe	bacon Dripping
Creme de la Crepe	cereal plain
Creme de la Crepe	hamburger hash Dull
Creme de la Crepe	black beans Luscious
Crepes Sans Frontieres	bitter prickly
Crepes Sans Frontieres	cereal Flaky
Crepes Sans Frontieres	appetite Candied
Crepes Sans Frontieres	daily bread Flavorful
Crepes Sans Frontieres	herbs Chocolate
Crepeville	cayenne pepper celery overpowering
Crepeville	diner Brown
Crepeville	breadfruit mellow
Crepeville	broil plump
Crepeville	casserole Blazed
Crust	diner mellow
Crust	daily bread Edible
Crust	Brussels sprouts buckwheat Edible
Crust	bagel Flavored
Crust	barley mashed
\.


--
-- Data for Name: restaurant; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.restaurant (nom_res, adresse_res, horrais_ouvri, horrais_ferme, mot_clef, statut_res, code_postal_res) FROM stdin;
Au Revoir French Bistro	11 Alsace-Lorraine (Rue de)	10:00:00	01:00:00	boulette frite,brioches,Broc	disponible	93330
Blue Moon Over Avila	19 Baignade (Rue de la)	10:00:00	24:00:00	jambon blanc,jardinieres,cucurbitacee,Broc,cuilleres	disponible	93160
Boulud Sud	5 Alexandre 1er (Rue)	07:00:00	22:00:00	Buee,jardin dete,cuisine	disponible	93360
Cafe Des Artistes	12 Abel Tuffier (Villa)	09:00:00	24:00:00	cuisine arabe,Beuf,jam,boulette de viande	disponible	93330
Chez Maman	10 Bouvreuils (Allee des)	07:00:00	23:00:00	jambon de porc,cuisine americaine,burger,jardin paysan	disponible	93360
Cocotte	23 Antoine de Saint-Exupery (Rue)	07:00:00	23:00:00	creme fleurette	indisponible	93360
Creme de la Crepe	23 Alexandre Pottier (Rue)	07:00:00	24:00:00	cuisine americaine	indisponible	93130
Crepes Sans Frontieres	22 Copernic (Rue)	08:00:00	01:00:00	couscous,bouteille de vin	disponible	93130
Crepeville	5 Artois (Allee d)	09:00:00	22:00:00	Buee,jambon blanc,jardins paysans,cuire au four,Cucumber	disponible	93330
Crust	3 Bas Heurts (Rue des)	10:00:00	22:00:00	Jambon,jambon desosse saumure	disponible	93160
\.


--
-- Data for Name: ultilisateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ultilisateur (email_ult, mdp_ult, nom_ult, prenom_ult, adresse_ult, tel_ult, carte_bancaire, point_ult, code_postal_ult) FROM stdin;
AlbertNoémie58@mail.com	DBV6BM7DZZ	Albert	Noémie	23 Bienvenue (Allee)	255179908	9050761618460277	47	93160
LemoineSylvain51@mail.com	W9FI6GKTIG	Lemoine	Sylvain	19 Coubre-Mille (Rue)	588766042	3480671175073770	38	93360
OrchidThomas33@mail.com	2SEZJN2PSY	Orchid	Thomas	22 Chanzy (Rue de)	418386368	7229363990667560	22	93360
HadrienDiane50@mail.com	BDCAXACTMH	Hadrien	Diane	19 Avron (Rue de)	389359416	6178297513666550	47	93330
ImonQueene62@mail.com	ONCAOQYBR1	Imon	Queene	25 Bleuets (Allee, des)	340810900	4204813630691421	27	93360
FannotWilliam24@mail.com	ZNJBX27TQQ	Fannot	William	10 Coli (Passage)	443232942	8428765156174198	20	93360
NguyenManon23@mail.com	B3O80OIZW6	Nguyen	Manon	8 Clocher (Avenue du)	286539702	2703101571961306	5	93130
ChaslesOmar30@mail.com	AONTP8BZHI	Chasles	Omar	19 Bel-Air (Chemin du)	347733977	3718173430851599	20	93360
ChaslesFrançois26@mail.com	TMRS7BZIYE	Chasles	François	22 Coubre-Mille (Rue)	230775073	4080105427954363	9	93360
QarthVincent39@mail.com	WXKS5J7EVJ	Qarth	Vincent	10 Cahouettes (Chemin des)	916921117	1494899792980237	43	93360
\.


--
-- Data for Name: ville; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ville (code_postal, nom_vil) FROM stdin;
93360	Neuilly-Plaisance
93330	Neuilly-sur-Marne
93160	Noisy-le-Grand
93130	Noisy-le-Sec
\.


--
-- Name: commande_id_com_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commande_id_com_seq', 5, true);


--
-- Name: contient_id_com_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contient_id_com_seq', 1, false);


--
-- Name: commande commande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_pkey PRIMARY KEY (id_com);


--
-- Name: livreur livreur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.livreur
    ADD CONSTRAINT livreur_pkey PRIMARY KEY (mat_liv);


--
-- Name: plat plat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plat
    ADD CONSTRAINT plat_pkey PRIMARY KEY (nom_plat);


--
-- Name: restaurant restaurant_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.restaurant
    ADD CONSTRAINT restaurant_pkey PRIMARY KEY (nom_res);


--
-- Name: ultilisateur ultilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ultilisateur
    ADD CONSTRAINT ultilisateur_pkey PRIMARY KEY (email_ult);


--
-- Name: ville ville_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ville
    ADD CONSTRAINT ville_pkey PRIMARY KEY (code_postal);


--
-- Name: commande commande_email_ult_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_email_ult_fkey FOREIGN KEY (email_ult) REFERENCES public.ultilisateur(email_ult);


--
-- Name: commande commande_mat_liv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_mat_liv_fkey FOREIGN KEY (mat_liv) REFERENCES public.livreur(mat_liv);


--
-- Name: commande commande_nom_res_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_nom_res_fkey FOREIGN KEY (nom_res) REFERENCES public.restaurant(nom_res);


--
-- Name: commentaire commentaire_email_ult_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT commentaire_email_ult_fkey FOREIGN KEY (email_ult) REFERENCES public.ultilisateur(email_ult);


--
-- Name: commentaire commentaire_nom_res_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT commentaire_nom_res_fkey FOREIGN KEY (nom_res) REFERENCES public.restaurant(nom_res);


--
-- Name: contient contient_id_com_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contient
    ADD CONSTRAINT contient_id_com_fkey FOREIGN KEY (id_com) REFERENCES public.commande(id_com);


--
-- Name: contient contient_nom_plat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contient
    ADD CONSTRAINT contient_nom_plat_fkey FOREIGN KEY (nom_plat) REFERENCES public.plat(nom_plat);


--
-- Name: livreur livreur_code_postal_liv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.livreur
    ADD CONSTRAINT livreur_code_postal_liv_fkey FOREIGN KEY (code_postal_liv) REFERENCES public.ville(code_postal);


--
-- Name: parraine parraine_email_u_parrain_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parraine
    ADD CONSTRAINT parraine_email_u_parrain_fkey FOREIGN KEY (email_u_parrain) REFERENCES public.ultilisateur(email_ult);


--
-- Name: parraine parraine_email_ult_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parraine
    ADD CONSTRAINT parraine_email_ult_fkey FOREIGN KEY (email_ult) REFERENCES public.ultilisateur(email_ult);


--
-- Name: proposer proposer_nom_plat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proposer
    ADD CONSTRAINT proposer_nom_plat_fkey FOREIGN KEY (nom_plat) REFERENCES public.plat(nom_plat);


--
-- Name: proposer proposer_nom_res_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proposer
    ADD CONSTRAINT proposer_nom_res_fkey FOREIGN KEY (nom_res) REFERENCES public.restaurant(nom_res);


--
-- Name: restaurant restaurant_code_postal_res_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.restaurant
    ADD CONSTRAINT restaurant_code_postal_res_fkey FOREIGN KEY (code_postal_res) REFERENCES public.ville(code_postal);


--
-- Name: ultilisateur ultilisateur_code_postal_ult_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ultilisateur
    ADD CONSTRAINT ultilisateur_code_postal_ult_fkey FOREIGN KEY (code_postal_ult) REFERENCES public.ville(code_postal);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

