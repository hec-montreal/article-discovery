<?php
/**
 * @file
 * Formats $data as RIS.
 *
 * @param $data
 *   $data is an associative array containing metadata to be re-encoded as RIS
 *
 */
$data = $variables['data'];
 
$rtmap = array(
  'no-such-entity'                => 'ABST',
  'Art'                           => 'ART',
  'Graphic Art'                   => 'ART',
  'Image'                         => 'ART',
  'Online Image'                  => 'ART',
  'Painting'                      => 'ART',
  'Photograph'                    => 'ART',
  'no-such-entity'                => 'BILL',
  'Book Chapter'                  => 'CHAP',
  'Book'                          => 'BOOK',
  'eBook'                         => 'BOOK',
  'Case'                          => 'CASE',
  'Computer File'                 => 'COMP',
  'Electronic Resource'           => 'COMP',
  'Software'                      => 'COMP',
  'Conference Proceeding'         => 'CONF',
  'Dissertation'                  => 'THES',
  'Online Dissertation'           => 'THES',
  'no-such-entity'                => 'UNPB',
  'Architectural Drawing'         => 'GEN',
  'Archival Material'             => 'GEN',
  'Archival Material/Manuscripts' => 'GEN',
  'Blueprints'                    => 'GEN',
  'Book Review'                   => 'GEN',
  'Catalog'                       => 'CTLG',
  'Ceremonial Object'             => 'GEN',
  'Clothing'                      => 'GEN',
  'Course Reading'                => 'GEN',
  'Data Set'                      => 'DATA',
  'Drawing'                       => 'GEN',
  'Equipment'                     => 'GEN',
  'Exam'                          => 'GEN',
  'Furnishing'                    => 'GEN',
  'Government Document'           => 'GEN',
  'Houseware'                     => 'GEN',
  'Ignored'                       => 'GEN',
  'Implements'                    => 'GEN',
  'Kit'                           => 'GEN',
  'Learning Object'               => 'GEN',
  'Manuscript'                    => 'GEN',
  'Microfilm'                     => 'GEN',
  'Microform'                     => 'GEN',
  'Mixed'                         => 'GEN',
  'Model'                         => 'GEN',
  'Musical Instrument'            => 'GEN',
  'Newsletter'                    => 'GEN',
  'Online Archival Material'      => 'GEN',
  'Pamphlet'                      => 'PAMP',
  'Paper'                         => 'GEN',
  'Personal Article'              => 'GEN',
  'Play'                          => 'GEN',
  'Poem'                          => 'GEN',
  'Postcard'                      => 'GEN',
  'Poster'                        => 'GEN',
  'Presentation'                  => 'GEN',
  'Publication'                   => 'GEN',
  'Publication Article'           => 'GEN',
  'Realia'                        => 'GEN',
  'Research Publication'          => 'GEN',
  'Serial'                        => 'SER',
  'Sheet Music'                   => 'GEN',
  'Slide'                         => 'SLIDE',
  'Special Collection'            => 'GEN',
  'Standard'                      => 'GEN',
  'Tool'                          => 'GEN',
  'Transcript'                    => 'GEN',
  'Unknown'                       => 'GEN',
  'no-such-entity'                => 'GEN',
  'no-such-entity'                => 'HEAR',
  'no-such-entity'                => 'ICOMM',
  'no-such-entity'                => 'INPR',
  'Article'                       => 'JOUR',
  'Journal Article'               => 'JOUR',
  'Journal'                       => 'JFULL',
  'Trade Publication Article'     => 'JOUR',
  'Trade Publication'             => 'JFULL',
  'eJournal'                      => 'JFULL',
  'Magazine'                      => 'MGZN',
  'Magazine Article'              => 'MGZN',
  'Atlas'                         => 'MAP',
  'Globe'                         => 'MAP',
  'Map'                           => 'MAP',
  'Maps and Atlases'              => 'MAP',
  'Film'                          => 'MPCT',
  'Filmstrip'                     => 'MPCT',
  'Music Score'                   => 'MUSIC',
  'Online Music Score'            => 'MUSIC',
  'Newspaper'                     => 'NEWS',
  'Newspaper Article'             => 'NEWS',
  'Patent'                        => 'PAT',
  'no-such-entity'                => 'PCOMM',
  'Report'                        => 'RPRT',
  'Album'                         => 'SOUND',
  'Audio Book on CD'              => 'SOUND',
  'Audio Book on Casette'         => 'SOUND',
  'Audio Recording'               => 'SOUND',
  'Audio Tape'                    => 'SOUND',
  'Compact Disc'                  => 'SOUND',
  'Music'                         => 'SOUND',
  'Music CD'                      => 'SOUND',
  'Music LP'                      => 'SOUND',
  'Music Manuscript'              => 'SOUND',
  'Music Recording'               => 'SOUND',
  'Online Audio Recording'        => 'SOUND',
  'Sound Recording'               => 'SOUND',
  'Spoken Word Recording'         => 'SOUND',
  'no-such-entity'                => 'STAT',
  'no-such-entity'                => 'UNBIL',
  'Online Video Recording'        => 'ADVS',
  'Video Casette'                 => 'VIDEO',
  'Video DVD'                     => 'VIDEO',
  'Video Recording'               => 'VIDEO',
  'Web Resource'                  => 'ICOMM',
);
$fields = array(
   'T1' => 'Title',
   'A1' => 'Author',
   'ID' => 'ID',
   'JF' => 'PublicationTitle',
   'VL' => 'Volume',
   'IS' => 'Issue',
   'SP' => 'StartPage',
   'KW' => array('Keywords', 'SubjectTerms'),
   //'CL' => 'ClassificationCodes',
   'N2' => 'Abstract',
   'Y1' => 'PublicationYear',
   'N1' => 'Notes',
   'ED' => 'Edition',
   'OP' => 'PageNote',
   'PB' => 'Publisher',
   'CY' => 'PublicationPlace',
   'SN' => array('ISSN', 'ISBN', 'EISSN', 'EISBN'),
   'UL' => 'URI',
);

?>
<?php if (is_array($data)): ?>
<?php foreach ($data as $record) {
        if (isset($record->Author_xml) && count($record->Author_xml)) {
          $record->Author = array();
          foreach ($record->Author_xml as $author_object) {
            $record->Author[] = $author_object->fullname;
          }
        }
?>
TY  - <?php print $rtmap[$record->ContentType[0]]; ?>

<?php
  foreach ($fields as $tag => $summon) {
    if (!is_array($summon)) {
      $summon = array($summon);
    }
    foreach ($summon as $summon_field) {
      if (isset($record->$summon_field) && is_array($record->$summon_field) && count($record->$summon_field)) {
        foreach ($record->$summon_field as $value) {
          foreach (explode("\n", $value ) as $line) {
            printf("%s  - %s\n", $tag, $line);
          }
        }
      }
    }
  }
?>
ER  -

<?php } ?>
<?php  endif;
