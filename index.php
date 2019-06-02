<!DOCTYPE html>
<html>
<head>
    <title>Intro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="author" content="Juan Jos&eacute; Garc&iacute; Ripoll">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="copyright" content
    <meta name="keywords" content="science, articles, preprints, physics, mathematics, computer science, arxiv">
    <meta name="robots" content="index">


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-cookies.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.8/angular-ui-router.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>

    <style type="text/css">
        .form-style-6 {
            font: 95% Arial, Helvetica, sans-serif;
            max-width: 400px;
            margin: 10px auto;
            padding: 16px;
            background: #f7f6f5;

        }

        .form-style-6 h1 {
            background: #413c7f;
            padding: 20px 0;
            font-size: 140%;
            font-weight: 300;
            text-align: center;
            color: #fff5ff;
            margin: -16px -16px 16px -16px;


        }

        .form-style-6 input[type="text"],
        .form-style-6 input[type="date"],
        .form-style-6 input[type="datetime"],
        .form-style-6 input[type="email"],
        .form-style-6 input[type="number"],
        .form-style-6 input[type="search"],
        .form-style-6 input[type="time"],
        .form-style-6 input[type="url"],
        .form-style-6 textarea,
        .form-style-6 select {
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;
            outline: none;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            width: 100%;
            background: #f4fff5;
            margin-bottom: 4%;
            border: 1px solid #ccc;
            padding: 3%;
            color: #555;
            font: 95% Arial, Helvetica, sans-serif;
        }

        .form-style-6 input[type="text"]:focus,
        .form-style-6 input[type="date"]:focus,
        .form-style-6 input[type="datetime"]:focus,
        .form-style-6 input[type="email"]:focus,
        .form-style-6 input[type="number"]:focus,
        .form-style-6 input[type="search"]:focus,
        .form-style-6 input[type="time"]:focus,
        .form-style-6 input[type="url"]:focus,
        .form-style-6 textarea:focus,
        .form-style-6 select:focus {
            box-shadow: 0 0 5px #3342d1;
            padding: 3%;
            border: 1px solid #2e2dd1;

        }

        .form-style-6 input[type="submit"],
        .form-style-6 input[type="button"] {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            width: 100%;
            padding: 3%;
            background: #3f38ca;
            border-bottom: 2px solid #392ac2;
            border-top-style: none;
            border-right-style: none;
            border-left-style: none;
            color: #fafffb;

        }

        .form-style-6 input[type="submit"]:hover,
        .form-style-6 input[type="button"]:hover {
            background: #2a2058;

        }

        body {
            background-size: 100%;
            margin-top: 15%;
        }
    </style>


</head>


<body>
<div></div>
<div class="form-style-6">
    <h1>What articles are you interested in?</h1>

    <form method="GET" action="query.php?{query}&{max_results}{start}">


        <label for="country"></label>

        <select id="query" name="query" placeholder="What are  you looking for">
            <option value="cat:astro-ph*">Astrophysics</option>
            <option value="cat:astro-ph.CO">Cosmology and Extragalactic Astrophysics</option>
            <option value="cat:astro-ph.EP">Earth and Planetary Astrophysics</option>
            <option value="cat:astro-ph.GA">Galaxy Astrophysics</option>
            <option value="cat:astro-ph.HE">High Energy Astrophysical Phenomena</option>
            <option value="cat:astro-ph.IM">Instrumentation and Methods for Astrophysics</option>
            <option value="cat:astro-ph.SR">Solar and Stella Astrophysics</option>
            <option value="cat:cond-mat*">Condensed Matter Physics</option>
            <option value="cat:cond-mat.dis-nn">Disordered Systems and Neural Networks</option>
            <option value="cat:cond-mat.mtrl-sci">Materials Science</option>
            <option value="cat:cond-mat.mes-hall">Mesoscale and Nanoscale Physics</option>
            <option value="cat:cond-mat.other">Other Condensed Matter</option>
            <option value="cat:cond-mat.quant-gas">Quantum Gases</option>
            <option value="cat:soft">Soft Condensed Matter</option>
            <option value="cat:cond-mat.stat-mech">Statistical Mechanics</option>
            <option value="cat:cond-mat.str-el">Strongly Correlated Electrons</option>
            <option value="cat:cond-mat.supr-con">Superconductivity</option>
            <option value="cat:gr-qc">General Relativity and Quantum Cosmology</option>
            <option value="cat:hep-ex">High Energy Physics - Experiment</option>
            <option value="cat:hep-lat">High Energy Physics - Lattice</option>
            <option value="cat:hep-ph">High Energy Physics - Phenomenology</option>
            <option value="cat:hep-th">High Energy Physics - Theory</option>
            <option value="cat:math-ph">Mathematical Physics</option>
            <option value="cat:nucl-ex">Nuclear Experiment</option>
            <option value="cat:nucl-th">Nuclear Theory</option>
            <option value="cat:physics*">Physics</option>
            <option value="cat:physics.acc-ph">Accelerator Physics</option>
            <option value="cat:physics.ao-ph">Atmospheric and Oceanic Physics</option>
            <option value="cat:physics.atom-ph">Atomic Physics</option>
            <option value="cat:physics.atm-clus">Atomic and Molecular Clusters</option>
            <option value="cat:physics.bio-ph">Biological Physics</option>
            <option value="cat:physics.chem-ph">Chemical Physics</option>
            <option value="cat:physics.class-ph">Classical Physics</option>
            <option value="cat:physics.comp-ph">Computational Physics</option>
            <option value="cat:physics.data-an">Data Analysis Statistics and Probability</option>
            <option value="cat:physics.flu-dyn">Fluid Dynamics</option>
            <option value="cat:physics.gen-ph">General Physics</option>
            <option value="cat:physics.geo-ph">Geophysics</option>
            <option value="cat:physics.hist-ph">History and Philosophy of Physics</option>
            <option value="cat:physics.ins-det">Instrumentation and Detectors</option>
            <option value="cat:physics.med-ph">Medical Physics</option>
            <option value="cat:physics.optics">Optics</option>
            <option value="cat:physics.ed-ph">Physics Education</option>
            <option value="cat:physics.soc-ph">Physics and Society</option>
            <option value="cat:physics.plasma-ph">Plasma Physics</option>
            <option value="cat:physics.pop-ph">Popular Physics</option>
            <option value="cat:physics.space-ph">Space Physics</option>
            <option value="cat:quant-ph">Quantum Physics</option>
            <option value="cat:math*">Mathematics</option>
            <option value="cat:math.AG">Algebraic Geometry</option>
            <option value="cat:math.AT">Algebraic Topology</option>
            <option value="cat:math.AP">Analysis of PDEs</option>
            <option value="cat:math.CT">Category Theory</option>
            <option value="cat:math.CA">Classical Analysis and ODEs</option>
            <option value="cat:math.CO">Combinatorics</option>
            <option value="cat:math.AC">Commutative Algebra</option>
            <option value="cat:math.CV">Complex Variables</option>
            <option value="cat:math.DG">Differential Geometry</option>
            <option value="cat:math.DS">Dynamical Systems</option>
            <option value="cat:math.FA">Functional Analysis</option>
            <option value="cat:math.GM">General Mathematics</option>
            <option value="cat:math.GN">General Topology</option>
            <option value="cat:math.GT">Geometric Topology</option>
            <option value="cat:math.GR">Group Theory</option>
            <option value="cat:math.HO">History and Overview</option>
            <option value="cat:math.IT">Information Theory</option>
            <option value="cat:math.KT">K-Theory and Homology</option>
            <option value="cat:math.LO">Logic</option>
            <option value="cat:math.MP">Mathematical Physics</option>
            <option value="cat:math.MG">Metric Geometry</option>
            <option value="cat:math.NT">Number Theory</option>
            <option value="cat:math.NA">Numerical Analysis</option>
            <option value="cat:math.OA">Operator Algebras</option>
            <option value="cat:math.OC">Optimization and Control</option>
            <option value="cat:math.PR">Probability</option>
            <option value="cat:math.QA">Quantum Algebra</option>
            <option value="cat:math.RT">Representation Theory</option>
            <option value="cat:math.RA">Rings and Algebras</option>
            <option value="cat:math.SP">Spectral Theory</option>
            <option value="cat:math.ST">Statistics Theory</option>
            <option value="cat:math.SG">Symplectic Geometry</option>
            <option value="cat:nlin*">Nonlinear Sciences</option>
            <option value="cat:nlin.AO">Adaptation and Self-Organizing Systems</option>
            <option value="cat:nlin.CG">Cellular Automata and Lattice Gases</option>
            <option value="cat:nlin.CD">Chaotic Dynamics</option>
            <option value="cat:nlin.SI">Exactly Solvable and Integrable Systems</option>
            <option value="cat:nlin.PS">Pattern Formation and Solitons</option>
            <option value="cat:cs*">Computer Research Repository</option>
            <option value="cat:cs.AI">Artificial Intelligence</option>
            <option value="cat:cs.CL">Computation and Language</option>
            <option value="cat:cs.CC">Computation Complexity</option>
            <option value="cat:cs.CE">Computation Engineering Finance and Science</option>
            <option value="cat:cs.CG">Computational Geometry</option>
            <option value="cat:cs.GT">Computer Science and Game Theory</option>
            <option value="cat:cs.CV">Computer Vision and Pattern Recognition</option>
            <option value="cat:cs.CY">Computers and Society</option>
            <option value="cat:cs.CR">Cryptography and Security</option>
            <option value="cat:cs.DS">Data Structures and Algorithms</option>
            <option value="cat:cs.DB">Databases</option>
            <option value="cat:cs.DL">Digital Libraries</option>
            <option value="cat:cs.DM">Discrete Mathematics</option>
            <option value="cat:cs.DC">Distributed Parallel and Cluster Computing</option>
            <option value="cat:cs.ET">Emerging Technologies</option>
            <option value="cat:cs.FL">Formal Languages and Automata Theory</option>
            <option value="cat:cs.GL">General Literature</option>
            <option value="cat:cs.GR">Graphics</option>
            <option value="cat:cs.AR">Hardware Architecture</option>
            <option value="cat:cs.HC">Human-Computer Interaction</option>
            <option value="cat:cs.IR">Information Retrieval</option>
            <option value="cat:cs.LG">Learning</option>
            <option value="cat:cs.LO">Logic in Computer Science</option>
            <option value="cat:cs.MS">Mathematical Software</option>
            <option value="cat:cs.MA">Multiagent Systems</option>
            <option value="cat:cs.MM">Multimedia</option>
            <option value="cat:cs.NI">Networking and Internet Architecture</option>
            <option value="cat:cs.NE">Neural and Evolutionary Computing</option>
            <option value="cat:cs.NA">Numerical Analysis</option>
            <option value="cat:cs.OS">Operating System</option>
            <option value="cat:cs.OH">Other Computer Science</option>
            <option value="cat:cs.PF">Performance</option>
            <option value="cat:cs.PL">Programming Languages</option>
            <option value="cat:cs.RO">Robotics</option>
            <option value="cat:cs.SI">Social and Information Networks</option>
            <option value="cat:cs.SE">Software Engineering</option>
            <option value="cat:cs.SD">Sound</option>
            <option value="cat:cs.SC">Symbolic Computation</option>
            <option value="cat:cs.SY">Systems and Control</option>
            <option value="cat:q-bio*">Quantitative Biology</option>
            <option value="cat:q-bio.BM">Biomolecules</option>
            <option value="cat:q-bio.CB">Cell Behavior</option>
            <option value="cat:q-bio.GN">Genomics</option>
            <option value="cat:q-bio.MN">Molecular Networks</option>
            <option value="cat:q-bio.NC">Neurons and Cognition</option>
            <option value="cat:q-bio.OT">Other Quatitative Biology</option>
            <option value="cat:q-bio.PE">Populations and Evolution</option>
            <option value="cat:q-bio.QM">Quantitative Methods</option>
            <option value="cat:q-bio.SC">Subcellular Processes</option>
            <option value="cat:q-bio.TO">Tissues and Organs</option>
            <option value="cat:q-fin*">Quantitative Finance</option>
            <option value="cat:q-fin.CP">Computational Finance</option>
            <option value="cat:q-fin.GN">General Finance</option>
            <option value="cat:q-fin.PM">Portfolio Management</option>
            <option value="cat:q-fin.PR">Pricing of Securities</option>
            <option value="cat:q-fin.RM">Risk Management</option>
            <option value="cat:q-fin.ST">Statistical Finance</option>
            <option value="cat:q-fin.TR">Trading and Market Microstructure</option>
            <option value="cat:stat*">Statistics</option>
            <option value="cat:stat.AP">Applications</option>
            <option value="cat:stat.CO">Computation</option>
            <option value="cat:stat.ML">Machine Learning</option>
            <option value="cat:stat.ME">Methodology</option>
            <option value="cat:stat.OT">Other Statistics</option>
            <option value="cat:stat.TH">Statistics Theory</option>
        </select>


        <input type="text" name="max_results" placeholder="Number of results to display"/>
        <input type="text" name="start" placeholder="Starting from"/>

        <input type="submit" value="Find"/>
    </form>
</div>


</body>
</html>
