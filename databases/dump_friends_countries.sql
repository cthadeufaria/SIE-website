

-- ***************************  INSTRUCTIONS TO IMPORT THE SCHEMA  friends_countries  ****************************

-- this schema is employed in the examples of the first part of the slides "Intro to Postgres and SQL


-- using Find/Replace All, replace the ocurrences of sie2345 in the orginal dump file by your login in PostgreSQL (e.g. INFI202175)
-- save the modified file

-- Sign In PostgreSQL with your account (e.g. INFI202175)
-- Click on Schemas
-- Click SQL (link in the top right corner of the page)
-- Paste the content of the modified dump file in the SQL window
-- Click in Execute to run the script

-- Attention:
-- If you already have a schema named friends_countries in your account, you should delete or rename it before you run the script. 
-- Otherwise, you'll get an error.

-----------------------------------------------------------------------------


--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.20
-- Dumped by pg_dump version 9.6.20

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

--
-- Name: friends_countries; Type: SCHEMA; Schema: -; Owner: sie2345
--

CREATE SCHEMA friends_countries;


ALTER SCHEMA friends_countries OWNER TO sie2345;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: countries; Type: TABLE; Schema: friends_countries; Owner: sie2345
--

CREATE TABLE friends_countries.countries (
    id integer NOT NULL,
    name character varying(15)
);


ALTER TABLE friends_countries.countries OWNER TO sie2345;

--
-- Name: countries_id_seq; Type: SEQUENCE; Schema: friends_countries; Owner: sie2345
--

CREATE SEQUENCE friends_countries.countries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE friends_countries.countries_id_seq OWNER TO sie2345;

--
-- Name: countries_id_seq; Type: SEQUENCE OWNED BY; Schema: friends_countries; Owner: sie2345
--

ALTER SEQUENCE friends_countries.countries_id_seq OWNED BY friends_countries.countries.id;


--
-- Name: friends; Type: TABLE; Schema: friends_countries; Owner: sie2345
--

CREATE TABLE friends_countries.friends (
    id integer NOT NULL,
    name character varying(15),
    age integer,
    country integer
);


ALTER TABLE friends_countries.friends OWNER TO sie2345;

--
-- Name: friends_id_seq; Type: SEQUENCE; Schema: friends_countries; Owner: sie2345
--

CREATE SEQUENCE friends_countries.friends_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE friends_countries.friends_id_seq OWNER TO sie2345;

--
-- Name: friends_id_seq; Type: SEQUENCE OWNED BY; Schema: friends_countries; Owner: sie2345
--

ALTER SEQUENCE friends_countries.friends_id_seq OWNED BY friends_countries.friends.id;


--
-- Name: countries id; Type: DEFAULT; Schema: friends_countries; Owner: sie2345
--

ALTER TABLE ONLY friends_countries.countries ALTER COLUMN id SET DEFAULT nextval('friends_countries.countries_id_seq'::regclass);


--
-- Name: friends id; Type: DEFAULT; Schema: friends_countries; Owner: sie2345
--

ALTER TABLE ONLY friends_countries.friends ALTER COLUMN id SET DEFAULT nextval('friends_countries.friends_id_seq'::regclass);


--
-- Data for Name: countries; Type: TABLE DATA; Schema: friends_countries; Owner: sie2345
--

INSERT INTO friends_countries.countries VALUES (1, 'Portugal');
INSERT INTO friends_countries.countries VALUES (2, 'Spain');
INSERT INTO friends_countries.countries VALUES (3, 'France');
INSERT INTO friends_countries.countries VALUES (4, 'UK');


--
-- Name: countries_id_seq; Type: SEQUENCE SET; Schema: friends_countries; Owner: sie2345
--

SELECT pg_catalog.setval('friends_countries.countries_id_seq', 4, true);


--
-- Data for Name: friends; Type: TABLE DATA; Schema: friends_countries; Owner: sie2345
--

INSERT INTO friends_countries.friends VALUES (1, 'Pablo', 24, 2);
INSERT INTO friends_countries.friends VALUES (3, 'Luis', 30, 1);
INSERT INTO friends_countries.friends VALUES (5, 'John', 26, 4);
INSERT INTO friends_countries.friends VALUES (6, 'Carolina', 27, 1);
INSERT INTO friends_countries.friends VALUES (7, 'John', 24, 4);
INSERT INTO friends_countries.friends VALUES (4, 'John', 24, 4);
INSERT INTO friends_countries.friends VALUES (2, 'Claire', 21, 3);


--
-- Name: friends_id_seq; Type: SEQUENCE SET; Schema: friends_countries; Owner: sie2345
--

SELECT pg_catalog.setval('friends_countries.friends_id_seq', 8, true);


--
-- Name: countries countries_pkey; Type: CONSTRAINT; Schema: friends_countries; Owner: sie2345
--

ALTER TABLE ONLY friends_countries.countries
    ADD CONSTRAINT countries_pkey PRIMARY KEY (id);


--
-- Name: friends friends_pkey; Type: CONSTRAINT; Schema: friends_countries; Owner: sie2345
--

ALTER TABLE ONLY friends_countries.friends
    ADD CONSTRAINT friends_pkey PRIMARY KEY (id);


--
-- Name: friends friends_country_fkey; Type: FK CONSTRAINT; Schema: friends_countries; Owner: sie2345
--

ALTER TABLE ONLY friends_countries.friends
    ADD CONSTRAINT friends_country_fkey FOREIGN KEY (country) REFERENCES friends_countries.countries(id);


--
-- PostgreSQL database dump complete
--

