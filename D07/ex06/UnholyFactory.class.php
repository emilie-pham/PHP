<?php
class UnholyFactory{
	private $soldat = array();
	public function absorb($fighter) {
		if (get_parent_class($fighter)) {
			if (!isset($this->soldat[$fighter->getName()])) {
				print("(Factory already absorbed a fighter of type ".$fighter->getName().")\n");
				$this->soldat[$fighter->getName()] = $fighter;
			}
			else
				print("(Factory absorbed a fighter of type ".$fighter->getName().")\n");
		}
		else
			print("(Factory can't absorb this, it's not a fighter)\n");
	}
	public function fabricate($fighter)
	{
		if (array_key_exists($fighter, $this->soldat)) {
			print("(Factory fabricates a fighter of type " . $fighter . ")\n");
			return (clone $this->soldat[$fighter]);
		}
		print("(Factory hasn't absorbed any fighter of type " . $fighter . ")\n");
		return null;
	}
}
?>